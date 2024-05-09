<?php

    namespace App\Http\Controllers;

    use App\Models\MemberPage;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class MemberPageController extends Controller
    {
        public function index()
        {
            $memberPages = MemberPage::all();
            return response()->json(['memberPages' => $memberPages], 200);
        }

        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'photo' => 'required|array',
                'name' => 'required|string',
                'position' => 'required|array',
                'tools' => 'required|array',
                'education' => 'required|array',
                'github' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $memberPage = MemberPage::create($request->all());

            return response()->json(['memberPage' => $memberPage], 201);
        }

        public function show($id)
        {
            $memberPage = MemberPage::find($id);

            if (!$memberPage) {
                return response()->json(['error' => 'Member Page not found'], 404);
            }

            return response()->json(['memberPage' => $memberPage], 200);
        }

        public function update(Request $request, $id)
        {
            $memberPage = MemberPage::find($id);

            if (!$memberPage) {
                return response()->json(['error' => 'Member Page not found'], 404);
            }

            $validator = Validator::make($request->all(), [
                'photo' => 'array',
                'name' => 'string',
                'position' => 'array',
                'tools' => 'array',
                'education' => 'array',
                'github' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $memberPage->update($request->all());

            return response()->json(['memberPage' => $memberPage], 200);
        }

        public function destroy($id)
        {
            $memberPage = MemberPage::find($id);

            if (!$memberPage) {
                return response()->json(['error' => 'Member Page not found'], 404);
            }

            $memberPage->delete();

            return response()->json(['message' => 'Member Page deleted successfully'], 200);
        }
    }

