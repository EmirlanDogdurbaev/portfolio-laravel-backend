<?php

    namespace App\Http\Controllers;

    use App\Models\Achievement;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class AchievementController extends Controller
    {
        public function index()
        {
            $achievements = Achievement::all();
            return response()->json(['achievements' => $achievements], 200);
        }

        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'description' => 'required|string',
                'organisation' => 'required|string',
                'deadline' => 'required|string',
                'tools' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $achievement = Achievement::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'organisation' => $request->input('organisation'),
                'deadline' => $request->input('deadline'),
                'tools' => $request->input('tools'),
            ]);

            return response()->json(['achievement' => $achievement], 201);
        }

        public function show($id)
        {
            $achievement = Achievement::find($id);

            if (!$achievement) {
                return response()->json(['error' => 'Achievement not found'], 404);
            }

            return response()->json(['achievement' => $achievement], 200);
        }

        public function update(Request $request, $id)
        {
            $achievement = Achievement::find($id);

            if (!$achievement) {
                return response()->json(['error' => 'Achievement not found'], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'description' => 'required|string',
                'organisation' => 'required|string',
                'deadline' => 'required|string',
                'tools' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $achievement->title = $request->input('title');
            $achievement->description = $request->input('description');
            $achievement->organisation = $request->input('organisation');
            $achievement->deadline = $request->input('deadline');
            $achievement->tools = $request->input('tools');

            $achievement->save();

            return response()->json(['achievement' => $achievement], 200);
        }

        public function destroy($id)
        {
            $achievement = Achievement::find($id);

            if (!$achievement) {
                return response()->json(['error' => 'Achievement not found'], 404);
            }

            $achievement->delete();

            return response()->json(['message' => 'Achievement deleted successfully'], 200);
        }
    }
