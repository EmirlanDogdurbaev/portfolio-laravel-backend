<?php

    namespace App\Http\Controllers;

    use App\Models\AboutPage;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class AboutPageController extends Controller
    {

        public function index(): \Illuminate\Http\JsonResponse
        {
            $aboutPage = AboutPage::first();

            if (!$aboutPage) {

                return response()->json(['error' => 'Страница "О нас" не найдена'], 404);
            }

            return response()->json(['aboutPage' => $aboutPage], 200);
        }

        public function update(Request $request): \Illuminate\Http\JsonResponse
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'description' => 'required|string',
                'mini_description' => 'required|string',
                'education' => 'nullable|array',
                'education.*' => 'string',
                'tools' => 'nullable|array',
                'tools.*' => 'string',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $aboutPage = AboutPage::firstOrNew();

            $aboutPage->title = $request->input('title');
            $aboutPage->description = $request->input('description');
            $aboutPage->mini_description = $request->input('mini_description');

            if ($request->has('education') && is_array($request->input('education'))) {
                $educationJson = json_encode($request->input('education'), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                $aboutPage->education = $educationJson;
            }

            if ($request->has('tools') && is_array($request->input('tools'))) {
                $toolsJson = json_encode($request->input('tools'), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                $aboutPage->tools = $toolsJson;
            }

            $aboutPage->save();

            return response()->json(['aboutPage' => $aboutPage], 200);
        }
    }
