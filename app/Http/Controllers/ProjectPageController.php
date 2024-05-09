<?php

    namespace App\Http\Controllers;

    use App\Models\ProjectPage;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class ProjectPageController extends Controller
    {
        // Получение списка всех страниц проектов
        public function index(): \Illuminate\Http\JsonResponse
        {
            $projectPages = ProjectPage::all();
            return response()->json(['projectPages' => $projectPages], 200);
        }

        // Создание новой страницы проекта
        public function store(Request $request): \Illuminate\Http\JsonResponse
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'mini_description' => 'required|string',
                'description' => 'required|string',
                'tools' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $projectPage = ProjectPage::create([
                'title' => $request->input('title'),
                'mini_description' => $request->input('mini_description'),
                'description' => $request->input('description'),
                'tools' => $request->input('tools'),
            ]);

            return response()->json(['projectPage' => $projectPage], 201);
        }

        // Обновление страницы проекта
        public function update(Request $request, $id): \Illuminate\Http\JsonResponse
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'mini_description' => 'required|string',
                'description' => 'required|string',
                'tools' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $projectPage = ProjectPage::find($id);

            if (!$projectPage) {
                return response()->json(['error' => 'Страница проекта не найдена'], 404);
            }

            $projectPage->title = $request->input('title');
            $projectPage->mini_description = $request->input('mini_description');
            $projectPage->description = $request->input('description');
            $projectPage->tools = $request->input('tools');

            $projectPage->save();

            return response()->json(['projectPage' => $projectPage], 200);
        }

        public function show($id): \Illuminate\Http\JsonResponse
        {
            $projectPage = ProjectPage::find($id);

            if (!$projectPage) {
                return response()->json(['error' => 'Страница проекта не найдена'], 404);
            }

            return response()->json(['projectPage' => $projectPage], 200);
        }
    }
