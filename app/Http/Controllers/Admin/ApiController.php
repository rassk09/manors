<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventFormat;
use App\Models\EventFormatImage;
use App\Models\EventLog;
use App\Models\EventType;
use App\Models\EventTypeImage;
use App\Models\Test;
use App\Models\TestPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Admin\UploadHandler;
use App\Mail\MailSend;

class ApiController extends Controller
{
    public function getEventPhotos(Request $request, $id)
    {
        $out = ['files' => []];
        $event = \App\Models\Event::findOrFail($id);
        $images = $event->photos;

        foreach($images as $image) {
            $file = public_path($image->image);
            if (File::exists($file)) {
                $out['files'][] = $image->jsonResponse();
            }
        }

        return response()->json($out, 200);
    }

    public function deleteEventPhotos(Request $request, $id, $image_id)
    {
        $event = \App\Models\Event::findOrFail($id);
        $image = \App\Models\EventPhoto::where('id', '=', $image_id)
            ->where('event_format_id', '=', $id)
            ->firstOrFail();
        $image->delete();

        return response()->json([
            $image->image => true,
        ], 200);
    }

    public function getEventFormatImages(Request $request, $id)
    {
        $out = ['files' => []];
        $event_format = \App\Models\EventFormat::findOrFail($id);
        $images = $event_format->images;

        foreach($images as $image) {
            $file = public_path($image->image);
            if (File::exists($file)) {
                $out['files'][] = $image->jsonResponse();
            }
        }

        return response()->json($out, 200);
    }

    public function deleteEventFormatImages(Request $request, $id, $image_id)
    {
        $event_format = \App\Models\EventFormat::findOrFail($id);
        $image = \App\Models\EventFormatImage::where('id', '=', $image_id)
            ->where('event_format_id', '=', $id)
            ->firstOrFail();
        $image->delete();

        return response()->json([
            $image->image => true,
        ], 200);
    }

    public function getEventTypeImages(Request $request, $id)
    {
        $out = ['files' => []];
        $event_type = \App\Models\EventType::findOrFail($id);
        $images = $event_type->images;

        foreach($images as $image) {
            $file = public_path($image->image);
            if (File::exists($file)) {
                $out['files'][] = $image->jsonResponse();
            }
        }

        return response()->json($out, 200);
    }

    public function deleteEventTypeImages(Request $request, $id, $image_id)
    {
        $event_type = \App\Models\EventType::findOrFail($id);
        $image = \App\Models\EventTypeImage::where('id', '=', $image_id)
            ->where('event_type_id', '=', $id)
            ->firstOrFail();
        $image->delete();

        return response()->json([
            $image->image => true,
        ], 200);
    }

    public function getAllUsers(Request $request)
    {
        $users = \App\Models\User::getAllUsers();
        return json_encode($users);
    }

    // TODO: REWRITE
    public function uploadEventImage(Request $request)
    {
        $upload_path = '/uploads/events/';
        $upload_handler = new UploadHandler([
            'upload_dir' => public_path($upload_path),
            'upload_url' => $upload_path,
        ]);

        $response = $upload_handler->get_response();
        if ($file = $response['files'][0]) {
            return $file->url;
        }
    }

    public function getEventMembers(Request $request, $id)
    {
        $out = [];
        $event = \App\Models\Event::findOrFail($id);
        if($event->members) {
            foreach($event->members as $member) {
                $out[] = [
                    'id' => $member->id,
                    'name' => $member->name,
                    'email' => $member->email,
                    'phone' => $member->phone,
                    'type' => $member->getTypeName(),
                ];
            }
        }

        return response()->json($out, 200);
    }

    public function swalSuccessResponse($text, $object = null, $button_text = 'Закрыть', $style = 'success', $button_style = 'btn btn-success')
    {
        $response = [
            'status' => 'success',
            'title' => 'Готово!',
            'text' => $text,
            'icon' => $style,
            'buttons' => [
                'confirm' => [
                    'text' => $button_text,
                    'visible' => true,
                    'closeModal' => true,
                    'className' => $button_style,
                ],
            ],
        ];

        if ($object) {
            $response['object'] = $object;
        }

        return response()->json($response, 200);
    }

    public function changeEventStatus(Request $request, $id)
    {
        $action = $request->action;
        $event = \App\Models\Event::findOrFail($id);
        $user = \Auth::user();

        if ($action == 'confirm') {
            $event->status_id = 5;
            $event->save();

            $city = $event->city;
            $city->total_events++;
            $city->save();

            EventLog::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
                'message' => $event->getStatus(),
            ]);

            MailSend::mail('event_confirmed_letter', $event->user->name, $event->user->email, $event);

            return $this->swalSuccessResponse('Мероприятие принято');

        } else if ($action == 'reject') {
            $reject_type_id = $request->reject_type_id;
            $message = $request->message;
            $rejected_types = \App\Models\Event::getRejectedTypes();

            \App\Models\EventMessage::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'message' => $reject_type_id != 1 ? $rejected_types[$reject_type_id] : $request->message,
            ]);

            $event->status_id = 6;
            $event->rejected_status_id = $reject_type_id;
            $event->save();

            EventLog::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
                'message' => 'Отклонено: ' . $reject_type_id == 1 ? $message : $rejected_types[$reject_type_id],
            ]);

            MailSend::mail('event_rejected_letter', $event->user->name, $event->user->email, $event);

            return $this->swalSuccessResponse('Мероприятие отклонено');
        }
    }



    // TODO: REWRITE
    public function uploadTestImage(Request $request)
    {
        $upload_path = '/uploads/tests/';
        $upload_handler = new UploadHandler([
            'upload_dir' => public_path($upload_path),
            'upload_url' => $upload_path,
        ]);

        $response = $upload_handler->get_response();
        if ($file = $response['files'][0]) {
            return $file->url;
        }
    }

    public function createOrEditTestQuestion(Request $request)
    {
        if ($request->id) {
            $question = \App\Models\TestQuestion::with('answers')->findOrFail($request->id);
        } else {
            $question = new \App\Models\TestQuestion;
        }

        $question->test_id = $request->test_id;
        $question->name = $request->name;
        $question->image = $request->image;
        $question->test_block_id = $request->test_block_id ?? 0;
        $question->save();

        if ($question->test_block_id) {
            $question->test_block_name = $question->getDevelopType();
        }

        return $this->swalSuccessResponse('Вопрос добавлен', $question);
    }

    public function deleteTestQuestion(Request $request)
    {
        $question = \App\Models\TestQuestion::findOrFail($request->question_id)
            ->delete();

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function positionTestQuestion(Request $request)
    {
        foreach($request->positions as $position => $id) {
            \App\Models\TestQuestion::find($id)->update([
                'position' => $position
            ]);
        }

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function getTestAnswers(Request $request)
    {
        $question = \App\Models\TestQuestion::findOrFail($request->question_id);
        return response()->json(['answers' => $question->answers], 200);
    }

    public function editTestAnswers(Request $request)
    {
        $is_correct = $request->is_correct ?? 0;
        $question = \App\Models\TestQuestion::findOrFail($request->question_id);
        \App\Models\TestQuestionAnswer::where('test_question_id', '=', $question->id)
            ->delete();

        foreach($request->answer as $key => $answer) {
            \App\Models\TestQuestionAnswer::create([
                'test_question_id' => $question->id,
                'name' => $answer['name'],
                'description' => $answer['description'] ?? '',
                'points' => $answer['points'] ?? null,
                'is_correct' => $question->test->test_format_id == 3 ? ($is_correct == $key ? 1 : 0) : 1,
            ]);
        }

        $return_question = \App\Models\TestQuestion::with('answers')->findOrFail($question->id);

        return $this->swalSuccessResponse('Вопрос добавлен', $return_question);

    }

    public function getTestResults(Request $request)
    {
        $results = \App\Models\TestResult::where('test_id', '=', $request->test_id)->get();
        return response()->json(['results' => $results], 200);
    }

    public function getTestResult(Request $request)
    {
        $result = \App\Models\TestResult::findOrFail($request->result_id);
        return response()->json(['result' => $result], 200);
    }

    public function createOrUpdateTestResult(Request $request)
    {
        if ($request->id) {
            $result = \App\Models\TestResult::with('test')->findOrFail($request->id);
        } else {
            $result = new \App\Models\TestResult;
        }

        $result->fill($request->all());
        $result->save();

        return $this->swalSuccessResponse('Вопрос добавлен', $result);
    }

    public function deleteTestResult(Request $request)
    {
        $result = \App\Models\TestResult::findOrFail($request->result_id)
            ->delete();

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function storeTestsPages(Request $request)
    {
        foreach ($request->positions as $test_id => $position){
            \App\Models\TestPage::where('id', $test_id)->update([
                'sortable' => $position['sortable'],
                'x' => ceil($position['x'] / 3),
                'y' => ceil($position['y'] / 3),
            ]);
        }
    }

    public function updateTestsPages(Request $request)
    {
        $test = \App\Models\TestPage::findOrFail($request->test_id);
        $test->image_size = $request->image_size;
        $test->save();
    }

    public function deleteTestsPages(Request $request)
    {
        $test = \App\Models\TestPage::findOrFail($request->id);
        $test->delete();
    }

    public function addTestsPages(Request $request)
    {
        $id = $request->id;
        parse_str(str_replace('?', '', $request->get('query')), $args);

        $y = TestPage::where('locale_id', '=', $args['locale_id'])
            ->where('test_category_id', '=', $args['category_id'])
            ->max('y');

        $test = TestPage::create([
            'test_id' => $id,
            'locale_id' => $args['locale_id'],
            'test_category_id' => $args['category_id'],
            'x' => 0,
            'y' => $y++,
            'sortable' => 0,
            'image_size' => 1
        ]);
    }

    public function resetTestsPages(Request $request)
    {
        $arr_new_ids = [];

        \App\Models\TestPage::where('locale_id', '=', $request->locale_id)
            ->where('test_category_id', '=', $request->category_id)
            ->delete();

        if ($request->category_id) {
            $new = \App\Models\Test::where('test_category_id', '=', $request->category_id)
                ->get()
                ->pluck('id');
        } else {
            $new = \App\Models\Test::all()
                ->pluck('id');
        }

        $arr_new_ids = array_merge($arr_new_ids, $new->toArray());

        if ($request->locale_id) {
            if ($request->category_id) {
                $new = \App\Models\TestLocale::whereIn('test_id', \App\Models\Test::where('test_category_id', '=', $request->category_id)->get()->pluck('id'))
                    ->where('locale_id', '=', $request->locale_id)
                    ->get()
                    ->pluck('test_id');
            } else {
                $new = \App\Models\TestLocale::where('locale_id', '=', $request->locale_id)
                    ->get()
                    ->pluck('test_id');
            }

            $arr_new_ids = array_merge($arr_new_ids, $new->toArray());
        }

        $arr_new_ids = array_unique($arr_new_ids);

        $x = 0;
        $y = 0;
        $k = 0;
        foreach($arr_new_ids as $new) {
            $k++;

            \App\Models\TestPage::create([
                'locale_id' => $request->locale_id,
                'test_category_id' => $request->category_id,
                'test_id' => $new,
                'image_size' => 1,
                'x' => $x,
                'y' => $y,
                'sortable' => $k,
            ]);

            $x++;
            if ($x == 4) {
                $x = 0;
                $y++;
            }
        }
    }

    // TODO: REWRITE
    public function uploadDocumentsFile(Request $request)
    {
        $upload_path = '/uploads/documents/';
        $upload_handler = new UploadHandler([
            'upload_dir' => public_path($upload_path),
            'upload_url' => $upload_path,
        ]);

        $response = $upload_handler->get_response();
        if ($file = $response['files'][0]) {
            return $file->url;
        }
    }

    // TODO: REWRITE
    public function uploadBeautyBooksImage(Request $request)
    {
        $upload_path = '/uploads/beauty_books/';
        $upload_handler = new UploadHandler([
            'upload_dir' => public_path($upload_path),
            'upload_url' => $upload_path,
        ]);

        $response = $upload_handler->get_response();
        if ($file = $response['files'][0]) {
            return $file->url;
        }
    }

    // TODO: REWRITE
    public function uploadMaterialsImage(Request $request)
    {
        $upload_path = '/uploads/materials/';
        $upload_handler = new UploadHandler([
            'upload_dir' => public_path($upload_path),
            'upload_url' => $upload_path,
        ]);

        $response = $upload_handler->get_response();
        if ($file = $response['files'][0]) {
            return $file->url;
        }
    }

    public function getPositions(Request $request)
    {
        $out = [
            'slides' => [],
            'subjects' => [],
            'today_blocks' => [],
            'videos' => [],
            'lifestyle_blocks' => [],
            'products' => [],
        ];

        $arr_blocks = \App\Models\Position::getBlocks();

        $positions = \App\Models\Position::orderBy('x', 'asc')
            ->orderBy('y', 'asc')
            ->with('material')
            ->get();

        foreach($positions as $position) {
            $block_id = $position->block_id;
            if (isset($arr_blocks[$block_id])) {
                $out[$arr_blocks[$block_id]][] = $position;
            }
        }

        return response()->json($out, 200);
    }

    public function getAllMaterials(Request $request)
    {
        return response()->json([
            'materials' => \App\Models\Material::where('is_active', '=', 1)->orderBy('id', 'desc')->with('types')->get()
        ], 200);
    }

    public function addPositions(Request $request)
    {
        if ($request->id) {
            $position = \App\Models\Position::findOrFail($request->id);
            $position->content = $request->get('content');
            $position->save();

        } else {
            $arr_blocks = array_flip(\App\Models\Position::getBlocks());
            $block_id = $request->block_id;

            $next_x = \App\Models\Position::where('block_id', '=', $arr_blocks[$block_id])
                ->max('x');

            if (in_array($block_id, ['slides', 'subjects', 'videos', 'products'])) {
                $position = \App\Models\Position::create([
                    'block_id' => $arr_blocks[$block_id],
                    'material_id' => $request->material_id,
                    'x' => $next_x + 1,
                ]);
            } else {
                $last_position = \App\Models\Position::where('block_id', '=', $arr_blocks[$block_id])
                    ->orderBy('y', 'desc')
                    ->orderBy('x', 'desc')
                    ->first();

                if ($last_position) {
                    $x = $last_position->x + $last_position->width;
                    $y = $last_position->y;

                    if ($x + $request->width > 12) {
                        $y += 10;
                        $x = 0;
                    }
                } else {
                    $x = 0;
                    $y = 0;
                }

                $position = \App\Models\Position::create([
                    'block_id' => $arr_blocks[$block_id],
                    'material_id' => $request->material_id,
                    'type_id' => $request->type_id,
                    'content' => $request->get('content'),
                    'x' => $x,
                    'y' => $y,
                    'width' => $request->width,
                    'height' => $request->height * 2,
                ]);
            }
        }

        $position = \App\Models\Position::with('material')
            ->find($position->id);

        return $this->swalSuccessResponse($request->id ? 'Текст изменен' : 'Блок добавлен', $position);
    }

    public function deletePosition(Request $request)
    {
        $position = \App\Models\Position::findOrFail($request->position_id)
            ->delete();

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function positionPositions(Request $request)
    {
        $arr = $request->positions;

        foreach($arr as $item) {
            if (isset($item['id'])) {
                \App\Models\Position::find($item['id'])
                    ->update([
                        'x' => $item['x'],
                        'y' => $item['y'],
                    ]);
            }
        }

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function additionalPositions(Request $request)
    {
        $position = \App\Models\Position::with('material')->findOrFail($request->id);

        $arr = [
            'bg_color' => $request->bg_color,
            'text_color' => $request->text_color,
        ];

        $position->additional_settings = json_encode($arr);
        $position->save();

        return $this->swalSuccessResponse('Свойства обновлены', $position);

    }

    public function cropPositions(Request $request)
    {
        $upload_path = '/uploads/homepage/';
        $upload_handler = new UploadHandler([
            'upload_dir' => public_path($upload_path),
            'upload_url' => $upload_path,
        ]);

        $response = $upload_handler->get_response();
        if ($file = $response['files'][0]) {
            $position = \App\Models\Position::with('material')->findOrFail($request->id);
            $position->cropped_image = $file->url;
            $position->save();

            return $this->swalSuccessResponse('Изображение сохранено', $position);
        }

    }

    public function publishPosition(Request $request)
    {
        \App\Models\PositionPublished::query()->truncate();
        $positions = \App\Models\Position::all()->toArray();
        \App\Models\PositionPublished::insert($positions);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function resetPosition(Request $request)
    {
        \App\Models\Position::query()->truncate();
        $positions = \App\Models\PositionPublished::all()->toArray();
        \App\Models\Position::insert($positions);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function uploadSettingImage(Request $request)
    {
        $upload_path = '/uploads/';
        $upload_handler = new UploadHandler([
            'upload_dir' => public_path($upload_path),
            'upload_url' => $upload_path,
        ]);

        $response = $upload_handler->get_response();
        if ($file = $response['files'][0]) {
            return $file->url;
        }
    }

    public function getEventFormat(Request $request)
    {
        $event_type = EventFormat::findOrFail($request->event_format_id);
        return response()->json($event_type, 200);
    }

    public function getAllEventCovers(Request $request)
    {
        $format_images = EventFormatImage::orderBy('id', 'desc')
            ->get()
            ->toArray();

        $type_images = EventTypeImage::orderBy('id', 'desc')
            ->get()
            ->toArray();

        return response()->json(array_merge($type_images, $format_images), 200);

    }

}
