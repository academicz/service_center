<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Models\Login;
use App\Models\Registration;
use App\Models\ServiceCenter;
use App\Models\ServiceFeedback;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestImage;
use App\Models\ShopType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function getHome()
    {
        $serviceCenters = ServiceCenter::where('status', Constants::$APPROVED_CENTER)->inRandomOrder()->limit(2)->get();
        return view('User.home', compact('serviceCenters'));
    }

    public function getUserRegistration()
    {
        return view('User.registration');
    }

    public function postUserRegistration(Request $request)
    {
        $request = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email|unique:registrations',
            'place' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
            'pinCode' => 'required|numeric',
        ]);

        $registration = new Registration();
        $registration->name = $request['name'];
        $registration->phone = $request['phone'];
        $registration->email = $request['email'];
        $registration->address = $request['address'];
        $registration->place = $request['place'];
        $registration->pin_code = $request['pinCode'];
        $registration->status = Constants::$ACTIVE_MEMBER;
        $registration->save();

        $login = new Login();
        $login->user_id = $registration->id;
        $login->email = $request['email'];
        $login->password = bcrypt($request['password']);
        $login->role = Constants::$CUSTOMER_USER;
        $login->save();

        Auth::loginUsingId($login->id);

        return redirect()->route('home');
    }

    public function getUserServiceCenter($id)
    {
        $serviceCenter = ServiceCenter::findOrFail($id);
        return view('User.service_center', compact('serviceCenter'));
    }

    public function getRequestService($id)
    {
        $serviceCenter = ServiceCenter::findOrFail($id);
        return view('User.request_service', compact('serviceCenter'));
    }

    public function postRequestService(Request $request)
    {
        $images = $request->file('images');
        $request = $request->validate([
            'images' => 'required|max:1000',
            'productName' => 'required',
            'model' => 'required',
            'companyName' => 'required',
            'issue' => 'required',
            'serviceCenter' => 'required',
        ]);

        $serviceRequst = new ServiceRequest();
        $serviceRequst->registration_id = user()->id;
        $serviceRequst->product_name = $request['productName'];
        $serviceRequst->model = $request['model'];
        $serviceRequst->company_name = $request['companyName'];
        $serviceRequst->issue = $request['issue'];
        $serviceRequst->service_center_id = $request['serviceCenter'];
        $serviceRequst->status = Constants::$UNAPPROVED_REQUEST;
        $serviceRequst->save();

        foreach ($images as $image) {
            $extension = $image->guessClientExtension();
            $name = uniqid('service-') . '.' . $extension;
            try {
                $imagePath = $image->storeAs(
                    'service_request',
                    $name
                );
                $img = new ServiceRequestImage();
                $img->service_request_id = $serviceRequst->id;
                $img->image_path = 'service_request/' . $name;
                $img->save();

                $status = true;
            } catch (Exception $e) {
                report($e);
                $status = false;
            }
        }

        return redirect()->route('getServiceCenter', ['id' => $request['serviceCenter']])->with(['success' => 'Service request send successfully']);
    }

    public function getMyAccount()
    {
        $serviceRequests = ServiceRequest::where('registration_id', user()->id)->get();

        return view('User.account', compact('serviceRequests'));
    }

    public function getRequestStatus($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        return view('User.request_status', compact('serviceRequest'));
    }

    public function viewBill($id)
    {
        $request = ServiceRequest::findOrFail($id);
        return view('User.invoice', compact('request'));
    }

    public function getPayment($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        session()->put('service', $id);
        return view('User.payment', compact('serviceRequest'));
    }

    public function postPayment(Request $request)
    {
        $request = $request->validate([
            'cardNumber' => 'required|numeric|digits:16',
            'name' => 'required',
            'cvv' => 'required|numeric|digits:3',
        ]);
        session()->put('request', $request);
        return redirect()->route('getBank');
    }

    public function getBank()
    {
        $serviceRequest = ServiceRequest::findOrFail(session()->get('service'));
        $request = session()->get('request');
        return view('User.bank', compact('serviceRequest', 'request'));
    }

    public function confirmPayment(Request $request)
    {
        if ($request['otp'] != 123456) {
            return redirect()->route('getBank')->with(['otpError' => 'Incorrect OTP']);
        }
        $bill = ServiceRequest::findOrFail(session()->get('service'))->bill;
        $bill->status = Constants::$PAYED_BILL;
        $bill->save();
        return redirect()->route('requestStatus', ['id' => session()->get('service')])->with(['success' => 'Payment Completed Successfully']);
    }

    public function search(Request $request)
    {
        $key = $request['key'];
        $serviceCenters = ServiceCenter::where([['status', Constants::$APPROVED_CENTER], ['name', 'like', '%' . $request['key'] . '%']])->orWhere([['status', Constants::$APPROVED_CENTER], ['place', 'like', '%' . $request['key'] . '%']])->get();
        return view('User.search', compact('serviceCenters', 'key'));
    }

    public function categoryShops($id)
    {
        $serviceCenters = ServiceCenter::where([['shop_type_id', $id], ['status', Constants::$APPROVED_CENTER]])->get();
        $key = ShopType::findOrFail($id)->shop_type;
        return view('User.search', compact('serviceCenters', 'key'));
    }

    public function addFeedback(Request $request)
    {
        echo $request['data']['serviceId'];
        $feedback = new ServiceFeedback();
        $feedback->service_id=$request['serviceId'];
        $feedback->title = $request['serviceId'];
        $feedback->description = $request['description'];
        $feedback->save();


        return redirect()->route('requestStatus',['id'=>$request['serviceId']]);

    }

}
