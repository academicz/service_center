<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Models\Committee;
use App\Models\CommitteeDesignation;
use App\Models\Education;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\Marriage;
use App\Models\Parish;
use App\Models\PrayerGroup;
use App\Models\Relation;
use App\Models\ServiceCenter;
use App\Models\ShopType;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class AdminController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHome()
    {
        return view('Admin.home');
    }

    public function getNewCenters()
    {
        $centers = ServiceCenter::where('status', Constants::$NEW_CENTER)->paginate(Constants::$PAGINATION);
        return view('Admin.new_centers', ['centers' => $centers]);
    }

    public function getServiceCenterDetails($id)
    {
        $center = ServiceCenter::findOrFail($id);
        return view('Admin.service_center', compact('center'));
    }

    public function changeCenterStatus($id)
    {
        $center = ServiceCenter::findOrFail($id);
        $center->status = $center->status == Constants::$APPROVED_CENTER ? Constants::$NEW_CENTER : Constants::$APPROVED_CENTER;
        $center->save();

        return redirect()->route('serviceCenter', ['id' => $id])->with(['success' => 'Service center registration approved']);
    }

    public function getShopTypes()
    {
        $shopTypes = ShopType::paginate(Constants::$PAGINATION);

        return view('Admin.shope_types', compact('shopTypes'));
    }

    public function postShopType(Request $request)
    {
        $request = $request->validate([
            'typeName' => 'required',
        ]);

        $shopType = new ShopType();
        $shopType->shop_type = $request['typeName'];
        $shopType->save();

        return redirect()->route('shopTypes')->with(['success' => 'Shop Type Added']);
    }

    public function postNewFamily(Request $request)
    {
        $request = $request->validate([
            'familyName' => 'required',
            'address' => 'required',
            'place' => 'required',
            'prayerGroup' => 'required'
        ]);

        $family = new Family();
        $family->name = $request['familyName'];
        $family->address = $request['address'];
        $family->place = $request['place'];
        $family->prayer_group_id = $request['prayerGroup'];
        $family->status = Constants::$ACTIVE_FAMILY;
        $family->save();

        return redirect()->route('addFamilyMember', ['id' => $family->id, 'name' => urlString($family->name)]);
    }

    public function addFamilyMember($id)
    {
        $relation = Relation::all();
        $education = Education::all();
        $family = Family::findOrFail($id);

        return view('Admin.add_member', ['relations' => $relation, 'educations' => $education, 'family' => $family]);
    }

    public function addFamilyMemberData(Request $request)
    {
        $request = $request->validate([
            'familyId' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'nickName' => 'required',
            'relationType' => '',
            'relationWith' => '',
            'dateOfBirth' => 'required',
            'education' => 'required',
            'occupation' => 'required',
            'presentPlace' => 'required',
            'phoneNumber' => '',
            'emailId' => '',
            'remarks' => '',
            'marriageDate' => ''
        ]);

        $familyMember = new FamilyMember();
        $familyMember->family_id = $request['familyId'];
        $familyMember->name = $request['name'];
        $familyMember->nick_name = $request['nickName'];
        $familyMember->relation_id = $request['relationType'];
        $familyMember->relation_with = $request['relationWith'];
        $familyMember->date_of_birth = $request['dateOfBirth'];
        $familyMember->marriage_date = $request['marriageDate'];
        $familyMember->education_id = $request['education'];
        $familyMember->occupation = $request['occupation'];
        $familyMember->current_city = $request['presentPlace'];
        $familyMember->phone = $request['phoneNumber'];
        $familyMember->email = $request['emailId'];
        $familyMember->remark = $request['remarks'];
        $familyMember->gender = $request['gender'];
        $familyMember->status = Constants::$ACTIVE_MEMBER;
        $familyMember->save();

        return redirect()->route('addFamilyMember', [
            'id' => $request['familyId'],
            'name' => urlString(Family::findOrFail($request['familyId'])->name)
        ])->with(['success' => 'Added family member.']);
    }

    public function getFamily($id)
    {
        $family = Family::findOrFail($id);
        return view('Admin.family', ['family' => $family]);
    }

    public function editFamily($id)
    {
        $family = Family::findOrFail($id);
        $prayerGroups = PrayerGroup::all();
        return view('Admin.edit_family', ['family' => $family, 'prayerGroups' => $prayerGroups]);
    }

    public function editFamilyData(Request $request)
    {
        $request = $request->validate([
            'familyName' => 'required',
            'address' => 'required',
            'place' => 'required',
            'famId' => 'required',
            'prayerGroup' => 'required'
        ]);

        $family = Family::findOrFail($request['famId']);
        $family->name = $request['familyName'];
        $family->address = $request['address'];
        $family->place = $request['place'];
        $family->prayer_group_id = $request['prayerGroup'];
        $family->status = Constants::$ACTIVE_FAMILY;
        $family->save();

        return redirect()->route('getFamily', ['id' => $request['famId'], 'name' => urlString($request['familyName'])]);
    }

    public function editMember($member)
    {
        $member = FamilyMember::findOrFail($member);
        $relation = Relation::all();
        $education = Education::all();

        return view('Admin.edit_member', [
            'member' => $member,
            'relations' => $relation,
            'educations' => $education
        ]);
    }

    public function editMemberData(Request $request)
    {
        $request = $request->validate([
            'memberId' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'nickName' => 'required',
            'relationType' => '',
            'relationWith' => '',
            'dateOfBirth' => 'required',
            'education' => 'required',
            'occupation' => 'required',
            'presentPlace' => 'required',
            'phoneNumber' => '',
            'emailId' => '',
            'remarks' => '',
            'marriageDate' => ''
        ]);

        $familyMember = FamilyMember::findOrFail($request['memberId']);
        $familyMember->name = $request['name'];
        $familyMember->gender = $request['gender'];
        $familyMember->nick_name = $request['nickName'];
        $familyMember->relation_id = $request['relationType'];
        $familyMember->relation_with = $request['relationWith'];
        $familyMember->date_of_birth = $request['dateOfBirth'];
        $familyMember->marriage_date = $request['marriageDate'];
        $familyMember->education_id = $request['education'];
        $familyMember->occupation = $request['occupation'];
        $familyMember->current_city = $request['presentPlace'];
        $familyMember->phone = $request['phoneNumber'];
        $familyMember->email = $request['emailId'];
        $familyMember->remark = $request['remarks'];

        try {
            $familyMember->save();
        } catch (Exception $e) {
            return redirect()->route('editMember', [
                'id' => $request['memberId'],
                'name' => urlString(Family::findOrFail($familyMember->family_id)->name)
            ])->with(['error' => 'Failed to update data']);
        }

        return redirect()->route('getFamily', [
            'id' => $familyMember->family_id,
            'name' => urlString(Family::findOrFail($familyMember->family_id)->name)
        ])->with(['success' => 'Member details updated']);
    }

    public function searchMember(Request $request)
    {
        $members = FamilyMember::when($request['gender'] != '', function ($q3) use ($request) {
            $q3->where('gender', $request['gender']);
        })->when($request['key'] != '', function ($q) use ($request) {
            $q->WhereHas('family', function ($q2) use ($request) {
                $q2->where('address', 'like', '%' . $request['key'] . '%')->orWhere('place', 'like', '%' . $request['key'] . '%');
            })->orWhere('name', 'like', '%' . $request['key'] . '%')->where('gender', $request['gender']);
        })->when($request['age'] != '', function ($q4) use ($request) {
            $ages = explode('-', $request['age']);
            if (sizeof($ages) == 1) {
                $year = Carbon::now()->subYears($request['age'])->year;
                $q4->whereYear('date_of_birth', $year);
            } else {
                $yearLow = Carbon::now()->subYears(trim($ages[0], ' '))->year;
                $yearHigh = Carbon::now()->subYears(trim($ages[1], ' '))->year;
                $q4->whereYear('date_of_birth', '<=', $yearLow)
                    ->whereYear('date_of_birth', '>=', $yearHigh);
            }
        })->when($request['option'] != '', function ($q5) use ($request) {
            if ($request['option'] == 1) {
                $year = Carbon::now()->subYears(60)->year;
                $q5->whereYear('date_of_birth', '<=', $year);
            } elseif ($request['option'] == 2) {
                $q5->where('marriage_date', '<>', null);
            }
        })->paginate(Constants::$PAGINATION);

        $members->appends(Input::all());

        if ($request->has('key') && $request->ajax()) {
            return view('Admin.Partials.member_search_result', ['members' => $members]);
        }
        return view('Admin.search_members', [
            'members' => $members,
            'key' => $request['key'],
            'gender' => $request['gender'],
            'age' => $request['age'],
            'option' => $request['option']
        ]);
    }

    public function showBirthday(Request $request)
    {
        $day = $request['day'];
        $members = FamilyMember::whereMonth('date_of_birth', date('m', strtotime($day)))
            ->whereDay('date_of_birth', date('d', strtotime($day)))->paginate(20);

        return view('Admin.birthday_cal', ['members' => $members]);
    }

    public function getCertificatePage()
    {
        $families = Family::all();

        return view('Admin.marriage_certificate', ['families' => $families]);
    }

    public function createCertificate(Request $request)
    {
        $request = $request->validate([
            'family' => 'required',
            'parish' => 'required',
            'bride' => 'required',
            'groom' => 'required',
            'parents' => 'required',
            'witness' => 'required',
            'priest' => 'required',
            'address' => 'required',
            'remarks' => ''
        ]);

        $certificate = new Marriage();
        $certificate->bride = $request['bride'];
        $certificate->groom = $request['groom'];
        $certificate->parish = $request['parish'];
        $certificate->name_of_parents = $request['parents'];
        $certificate->name_of_witness = $request['witness'];
        $certificate->priest_name = $request['priest'];
        $certificate->remarks = $request['remarks'];
        $certificate->bride_address = $request['address'];
        $certificate->save();

        return redirect()->route('showCertificate', ['id' => $certificate->id]);
    }

    public function showCertificate($id)
    {
        $certificate = Marriage::findOrFail($id);
        $parish = Parish::first();
        return view('Admin.certificate', [
            'certificate' => $certificate,
            'parish' => $parish
        ]);
    }

    public function getFamilyMemberList(Request $request)
    {
        $groom = null;
        if ($request->has('bride')) {
            if ($request['bride'] != '') { // if groom is selected preselect th bride
                $groom = FamilyMember::find($request['bride'])->groom->id;
            }
            $members = Family::findOrFail($request['family'])->family_members->where('gender', $request['gender']);
        } else {
            $members = Family::findOrFail($request['family'])->family_members;
        }
        return view('Admin.Partials.member_list', [
            'members' => $members,
            'groom' => $groom
        ]);
    }

    public function showMarriageDay(Request $request)
    {
        if ($request->has('day')) {
            $members = FamilyMember::whereMonth('marriage_date', $request['day'])->paginate(20);
        } else {
            $members = FamilyMember::where('marriage_date', '!=', null)->paginate(20);
        }

        return view('Admin.marriageday_cal', ['members' => $members]);
    }

    public function showMarriageCertificates()
    {
        $certificates = Marriage::paginate(Constants::$PAGINATION);
        return view('Admin.certificates', ['certificates' => $certificates]);
    }

    public function getPrayerGroups()
    {
        $prayerGroups = PrayerGroup::paginate(Constants::$PAGINATION);

        return view('Admin.add_prayer_group', ['prayerGroups' => $prayerGroups]);
    }

    public function postPrayerGroup(Request $request)
    {
        $request = $request->validate([
            'groupName' => 'required',
            'leader' => 'required',
            'secretary' => 'required',
            'treasurer' => 'required',
            'remarks' => ''
        ]);

        $prayerGroup = new PrayerGroup();
        $prayerGroup->name = $request['groupName'];
        $prayerGroup->leader = $request['leader'];
        $prayerGroup->secretary = $request['secretary'];
        $prayerGroup->treasurer = $request['treasurer'];
        $prayerGroup->remarks = $request['remarks'];
        $prayerGroup->save();

        return redirect()->route('getPrayerGroups')->with(['success' => 'Prayer group added.']);
    }

    public function deletePrayerGroup(Request $request)
    {
        try {
            PrayerGroup::where('id', $request['id'])->delete();
            $message = ['success' => 'Prayer group Deleted.'];
        } catch (Exception $e) {
            $message = ['error' => 'Oops! Can\'t delete Prayer Group,Families exist.'];
        }
        return redirect()->route('getPrayerGroups')->with($message);
    }

    public function getCommitteeDetails()
    {
        $committeeDesignations = CommitteeDesignation::all();
        $committies = Committee::all();
        $families = Family::all();

        return view('Admin.add_committee', [
            'designations' => $committeeDesignations,
            'committies' => $committies,
            'families' => $families
        ]);
    }

    public function postCommitteeMember(Request $request)
    {
        $request = $request->validate([
            'family' => 'required',
            'member' => 'required',
            'designation' => 'required',
        ]);
        $designationCount = CommitteeDesignation::findOrfail($request['designation'])->no_of_post;
        if (Committee::where('committee_designation_id', $request['designation'])->count() < $designationCount) {
            $committee = new Committee();
            $committee->family_member_id = $request['member'];
            $committee->committee_designation_id = $request['designation'];
            $committee->save();
            $message = ['success' => 'Committee Member Added'];
        } else {
            $message = ['error' => 'Member post already exist'];
        }

        return redirect()->route('getCommitteeDetails')->with($message);
    }

    public function deleteCommitteeMember(Request $request)
    {
        try {
            Committee::where('id', $request['id'])->delete();
            $message = ['success' => 'Committee Member Deleted.'];
        } catch (Exception $e) {
            $message = ['error' => 'Oops! Can\'t delete Committee Member, Please try again.'];
        }
        return redirect()->route('getCommitteeDetails')->with($message);
    }

    public function getPrayerGroupFamilies($id)
    {
        $families = Family::where('prayer_group_id', $id)->paginate(Constants::$PAGINATION);
        return view('Admin.families_in_prayer', ['families' => $families]);
    }

    public function deleteMember(Request $request)
    {
        $member = FamilyMember::findOrFail($request['id']);
        try {
            $member->delete();
            $message = ['success' => 'Member deleted.'];
        } catch (Exception $e) {
            $message = ['error' => 'Oops! Can\'t delete Member.'];
        }
        return redirect()->route('getFamily', [
                'id' => $member->family->id, 'name' => urlString($member->family->name)]
        )->with($message);
    }
    public function getAllShops()
    {
        $centers=ServiceCenter::paginate(Constants::$PAGINATION);
        return view('Admin.service_centers',compact('centers'));
    }
}