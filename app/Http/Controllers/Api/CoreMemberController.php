<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Http\Resources\CoreMemberResource;
use App\Libraries\FileResponseLibraries;
use App\Models\CoreMember;
use Illuminate\Http\Request;

class CoreMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request)
    {
        $lastMember = CoreMember::where('company_id', $request->company_id)->orderBy('created_at', 'desc')->first();
        if($lastMember) {
            $member_no = substr(pathinfo($lastMember->member_img, PATHINFO_FILENAME), 2) + 1;
        } else {
            $member_no = 1;
        }
        $member = new CoreMember;
        if ($request->hasFile('member_img')) {
            $member_img = $request->file('member_img');
            $fileName = "M_" . $member_no . '.' . $member_img->getClientOriginalExtension();
            FileResponseLibraries::uploadFile($member_img, "/{$request->company_id}/member/", $fileName);
            $member->member_img = $fileName;
        }
        $member->company_id = $request->company_id;
        $member->save();

        $languages = ['vi', 'en', 'ja'];
        $t_members = [
            'member_name' => json_decode($request->member_name, true),
            'member_position' => json_decode($request->member_position, true),
            'member_desc' => json_decode($request->member_desc, true)
        ];
        foreach ($languages as $language) {
            $queryData = ["language" => $language];
            foreach ($t_members as $key => $t_member) {
                if (isset($t_member[$language])) {
                    $queryData[$key] = $t_member[$language];
                }
            }
            if (!empty($queryData)) {
                $member->translate()->create($queryData);
            }
        }

        return response()->json([
            "message" => "Create member success",
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = CoreMember::where("company_id", $id)->get();

        return CoreMemberResource::collection($member);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = CoreMember::findOrFail($id);
        $oldFileName = pathinfo($member->member_img, PATHINFO_FILENAME);
        if ($request->hasFile('member_img')) {
            $member_img = $request->file("member_img");
            $fileName = $oldFileName . '.' . $member_img->getClientOriginalExtension();
            FileResponseLibraries::deleteFile("/{$member->company_id}/member/", $member->member_img);
            FileResponseLibraries::uploadFile($member_img, "/{$member->company_id}/member/", $fileName);
            $member->member_img = $fileName;
        }
        $member->save();

        $languages = ['vi', 'en', 'ja'];
        $t_member_datas = [
            'member_name' => json_decode($request->member_name, true),
            'member_position' => json_decode($request->member_position, true),
            'member_desc' => json_decode($request->member_desc, true)
        ];
        foreach ($languages as $language) {
            $updateData = [];
            foreach ($t_member_datas as $key => $t_member_data) {
                if (isset($t_member_data[$language])) {
                    $updateData[$key] = $t_member_data[$language];
                }
            }
            $t_member = $member->translate()->where('language', $language)->first();
            if (!empty($updateData) && $t_member) {
                $t_member->update($updateData);
            }
        }
        return (new CoreMemberResource($member))->additional(['message' => 'Member updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = CoreMember::find($id);
        if ($member) {
            FileResponseLibraries::deleteFile("/{$member->company_id}/member/", $member->member_img);
            $member->delete();
            return response()->json(['message' => 'Member deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Member not found'], 404);
        }
    }
}
