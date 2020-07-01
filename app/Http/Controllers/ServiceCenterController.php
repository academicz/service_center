<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Http\Resources\FormResource\StockResource;
use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Login;
use App\Models\Registration;
use App\Models\ReturnInfo;
use App\Models\ServiceCenter;
use App\Models\ServiceFeedback;
use App\Models\ServiceRequest;
use App\Models\ServiceResponse;
use App\Models\ShopImage;
use App\Models\ShopType;
use App\Models\Stock;
use App\Notifications\UserNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceCenterController extends Controller
{
    public function getHome()
    {
        return view('Shop.home');
    }

    public function getRegistration()
    {
        $shopTypes = ShopType::all();
        return view('User.shop_registration', compact('shopTypes'));
    }

    public function postRegistration(Request $request)
    {
        $images = $request->file('shopImage');
        $request = $request->validate([
            'shopName' => 'required',
            'description' => 'required',
            'shopImage' => 'required',
            'shopType' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email|unique:registrations',
            'place' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
            'pinCode' => 'required|numeric',
        ]);

        $registration = new ServiceCenter();
        $registration->name = $request['shopName'];
        $registration->phone = $request['phone'];
        $registration->email = $request['email'];
        $registration->address = $request['address'];
        $registration->place = $request['place'];
        $registration->pin_code = $request['pinCode'];
        $registration->shop_type_id = $request['shopType'];
        $registration->description = $request['description'];
        $registration->status = Constants::$NEW_CENTER;
        $registration->save();

        foreach ($images as $image) {
            $extension = $image->guessClientExtension();
            $name = uniqid('shop-') . '.' . $extension;
            try {
                $imagePath = $image->storeAs(
                    'shop_image',
                    $name
                );
                $img = new ShopImage();
                $img->service_center_id = $registration->id;
                $img->image_path = 'shop_image/' . $name;
                $img->save();

                $status = true;
            } catch (Exception $e) {
                report($e);
                $status = false;
            }
        }
        $login = new Login();
        $login->user_id = $registration->id;
        $login->email = $request['email'];
        $login->password = bcrypt($request['password']);
        $login->role = Constants::$SERVICE_CENTER_USER;
        $login->save();

        Auth::loginUsingId($login->id);
        return redirect()->route('shopHome');
    }

    public function getServiceRequests()
    {
        $requests = ServiceRequest::where('service_center_id', $this->getServiceCenter()->id)->paginate(Constants::$PAGINATION);
        return view('Shop.service_requests', compact('requests'));
    }
    public function addServiceReplay(Request $request){

        $feedback = ServiceFeedback::findOrFail($request['id']);
        $feedback->replay = $request['replay'];
        $feedback->save();
        return redirect()->route('serviceRequest',['id'=>$feedback->service_id]);
    }
    public function getServiceRequest($id)
    {
        $request = ServiceRequest::where([['id', $id], ['service_center_id', $this->getServiceCenter()->id]])->firstOrFail();

        return view('Shop.service_request', compact('request'));
    }

    public function getAcceptServiceRequestPage($id)
    {
        $request = ServiceRequest::where([['id', $id], ['service_center_id', $this->getServiceCenter()->id]])->firstOrFail();

        return view('Shop.accept_request', compact('request'));
    }

    public function acceptServiceRequest(Request $request)
    {
        $request = $request->validate([
            'pickUpdate' => 'required',
            'pickUpTime' => 'required',
            'pickUpLocation' => 'required',
            'requestId' => 'required',
            'pickUpAddress' => 'required',
            'advanceAmount' => 'numeric|nullable',
            'expectedReturnDate' => 'nullable',
            'note' => 'required',
        ]);

        $response = new ServiceResponse();
        $response->service_request_id = $request['requestId'];
        $response->pickup_date = $request['pickUpdate'];
        $response->pickup_time = $request['pickUpTime'];
        $response->pickup_address = $request['pickUpAddress'];
        $response->pickup_location = $request['pickUpLocation'];
        $response->advance_amount = $request['advanceAmount'];
        $response->expected_return_date = $request['expectedReturnDate'];
        $response->note = $request['note'];
        $response->status = Constants::$INITIAL_RESPONSE;
        $response->save();

        /**
         * Change request status
         */
        $serviceRequest = ServiceRequest::findOrFail($request['requestId']);
        $serviceRequest->status = Constants::$APPROVED_REQUEST;
        $serviceRequest->save();

        Login::where('user_id', $serviceRequest->registration->id)->get()->first()->notify(new UserNotification('Your service request is approved, more info on the account page'));

        return redirect()->route('serviceRequest', ['id' => $request['requestId']])->with(['success' => 'Service response send successfully']);
    }

    public function generateBill($id)
    {
        $request = ServiceRequest::where([['id', $id], ['service_center_id', $this->getServiceCenter()->id]])->firstOrFail();
//        $request->status = Constants::$CLOSED_REQUEST;
//        $request->save();

//        return redirect()->route('serviceRequest', ['id' => $id])->with(['success' => 'Service request clossed successfully']);
        return view('Shop.invoice', compact('request'));
    }

    public function getEditServiceResponsePage($id)
    {
        $response = $request = ServiceRequest::where([['id', $id], ['service_center_id', $this->getServiceCenter()->id]])->firstOrFail()->service_response;
        return view('Shop.edit_service_response', compact('response'));
    }

    public function editServiceResponse(Request $request)
    {
        $request = $request->validate([
            'pickUpdate' => 'required',
            'pickUpTime' => 'required',
            'pickUpLocation' => 'required',
            'requestId' => 'required',
            'pickUpAddress' => 'required',
            'advanceAmount' => 'numeric|nullable',
            'expectedReturnDate' => 'nullable',
        ]);

        $response = ServiceRequest::where([['id', $request['requestId']], ['service_center_id', $this->getServiceCenter()->id]])->firstOrFail()->service_response;
        $response->pickup_date = $request['pickUpdate'];
        $response->pickup_time = $request['pickUpTime'];
        $response->pickup_address = $request['pickUpAddress'];
        $response->pickup_location = $request['pickUpLocation'];
        $response->advance_amount = $request['advanceAmount'];
        $response->expected_return_date = $request['expectedReturnDate'];
        $response->status = Constants::$INITIAL_RESPONSE;
        $response->save();

        return redirect()->route('serviceRequest', ['id' => $response->service_request_id])->with(['success' => 'Service response updated successfully']);
    }

    public function changeRequestStatus($id, $status)
    {
        $request = ServiceRequest::findOrFail($id);
        $request->status = $status;
        $request->save();
        $message='';
        if ($status == Constants::$PICKED_UP) {
            $message = 'Your Product Marked As Picked Up By Service Center';
        } elseif ($status == Constants::$WORKING_ON_IT) {
            $message = 'Start working on your product';
        } elseif ($status == Constants::$CLOSED_REQUEST) {
            $message = 'Your service request closed successfully';
        }
        Login::where('user_id', $request->registration->id)->get()->first()->notify(new UserNotification($message));
        return redirect()->route('serviceRequest', ['id' => $id])
            ->with(['success' => 'Pickup updated successfully']);
    }

    public function postCloseServiceEntry(Request $request)
    {
        $bill = new Bill();
        $bill->service_request_id = $request['params']['request'];
        $bill->total = $request['params']['total'];
        $bill->status = Constants::$NEW_BILL;
        $bill->save();

        $service = ServiceRequest::findOrFail($request['params']['request']);
        $service->status = Constants::$BILL_GENERATED;
        $service->save();

        Login::where('user_id', $service->registration->id)->get()->first()->notify(new UserNotification('Your bill is available on the console'));

        foreach ($request['params']['invoices'] as $invoice) {
            $billItem = new BillItem();
            $billItem->bill_id = $bill->id;
            $billItem->description = $invoice['description'];
            $billItem->quantity = $invoice['quantity'];
            $billItem->price = $invoice['price'];
            $billItem->total = $invoice['total'];
            $billItem->save();

            if ($invoice['item']!==0){
                echo $invoice['item'];
                $stocks = Stock::findOrFail($invoice['item']);

                $stocks->stock = $stocks->stock - $invoice['quantity'];

                $stocks->save();
            }
        }

        return response()->json(['invoiceId' => $bill->id]);
    }

    public function viewBill($id)
    {
        $request = ServiceRequest::findOrFail($id);
        return view('Shop.invoice', compact('request'));
    }

    public function closeEntry($id)
    {
        $request = ServiceRequest::where([['id', $id], ['service_center_id', $this->getServiceCenter()->id]])->firstOrFail();
        return view('Shop.return_info', compact('request'));
    }

    public function postCloseEntry(Request $request)
    {
        $request = $request->validate([
            'returnTime' => 'required',
            'returnDate' => 'required',
            'returnLocation' => 'required',
            'requestId' => 'required',
            'returnAddress' => 'required',
            'status' => 'required',
        ]);

        $returnInfo = new ReturnInfo();
        $returnInfo->service_request_id = $request['requestId'];
        $returnInfo->return_date = $request['returnDate'];
        $returnInfo->return_time = $request['returnTime'];
        $returnInfo->return_address = $request['returnAddress'];
        $returnInfo->return_location = $request['returnLocation'];
        $returnInfo->status = $request['status'];
        $returnInfo->save();

        $req = ServiceRequest::findOrFail($request['requestId']);
        $req->status = Constants::$RETURN_INFORMED;
        $req->save();
        Login::where('user_id', $req->registration->id)->get()->first()->notify(new UserNotification('Your return info available on the console'));
        return redirect()->route('serviceRequest',
            ['id' => $request['requestId']])->with(['success' => 'Return Status Updated']);
    }

    public function getCustomers()
    {
        $customers = Registration::whereHas('service_requests', function ($q) {
            $q->where('service_center_id', shop()->id);
        })->paginate(Constants::$PAGINATION);

        return view('Shop.customers', compact('customers'));
    }

    public function getCustomer($id)
    {
        $customer = Registration::where('id', $id)->whereHas('service_requests', function ($q) {
            $q->where('service_center_id', shop()->id);
        })->firstOrFail();

        $requests = ServiceRequest::where('registration_id', $id)->paginate(Constants::$PAGINATION);

        return view('Shop.customer', compact('customer', 'requests'));
    }

    public function viewBills()
    {
        $bills = Bill::paginate(Constants::$PAGINATION);
        return view('Shop.bills', compact('bills'));

    }

    public function viewReport()
    {
        $bills = Bill::whereHas('service_request', function ($q) {
            $q->where('service_center_id', shop()->id);
        })->get();

        $requests = ServiceRequest::where('service_center_id', shop()->id)->get();

        return view('Shop.reports', compact('bills', 'requests'));
    }
    public function getStockPage(Request $request)
    {
        if($request->has('json')){
            $stocks = Stock::where('service_center_id', shop()->id)->paginate(10);
            return response()->json(
                    ['stocks' => StockResource::collection($stocks)]
            );
        } else {
            $stocks = Stock::where('service_center_id', shop()->id)->paginate(10);
//        $request->status = Constants::$CLOSED_REQUEST;
//        $request->save();

//        return redirect()->route('serviceRequest', ['id' => $id])->with(['success' => 'Service request clossed successfully']);
            return view('Shop.stock', compact('stocks'));
        }
    }
    public function saveStock(Request $request){
        $request = $request->validate([
            'item' => 'required',
            'amount' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
        $stock = new Stock();
        $stock->amount = $request['amount'];
        $stock->item=$request['item'];
        $stock->stock =$request['stock'];
        $stock->service_center_id = shop()->id;
        $stock->save();

        return redirect()->route('getStockPage')->with(['success' => 'Item Added']);
    }
}
