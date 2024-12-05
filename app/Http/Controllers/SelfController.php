<?php

namespace App\Http\Controllers;

use App\Models\SelfAssessment;
use App\Models\SelfQuestions;
use App\Models\Translations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SelfController extends Controller
{
    /**
     * Display a listing of the self assessment.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $self = SelfAssessment::all();

        return view('dashboard.self.self-list', ['selfs' => $self]);
    }

    public function showForm()
    {
        $selfs = SelfAssessment::with('questions')->get();

        return view('self-assessment', ['selfs' => $selfs]);
    }


    public function create()
    {
        return view('dashboard.self.self-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required',
        ]);

        $self = new SelfAssessment;
        $self->title_en = $request->title_en;
        $self->created_at = now();
        $self->updated_at = now();


        $self->save();

        return redirect()->route('dashboard.self.index', ['lang' => app()->getLocale()])
            ->with('status', 'self created successfully.');
    }

    public function edit($lang, SelfAssessment $self)
    {
        return view('dashboard.self.self-edit', compact('self'));
    }


    public function update(Request $request, $lang, SelfAssessment $self)
    {
        $request->validate([
            'title_en' => 'required'
        ]);

        $self->title_en = $request->title_en;

        $self->save();

        return redirect()->route('dashboard.self.index', ['lang' => app()->getLocale()])
            ->with('status', 'self updated successfully.');
    }

    public function translate($lang, SelfAssessment $self)
    {
        return view('dashboard.self.self-translate', compact('self'));
    }

    public function saveTranslations(Request $request, $lang, SelfAssessment $self)
    {
        $request->validate([
            'title_en' => 'required',
            'title_it' => 'required',
            'title_es' => 'required',
            'title_cat' => 'required',
            'title_bg' => 'required',
            'title_gr' => 'required',
        ]);

        $updateData = [];

        if ($request->filled('title_en')) {
            $updateData['title_en'] = strip_tags($request->input('title_en'));
        }
        if ($request->filled('title_it')) {
            $updateData['title_it'] = strip_tags($request->input('title_it'));
        }
        if ($request->filled('title_es')) {
            $updateData['title_es'] = strip_tags($request->input('title_es'));
        }
        if ($request->filled('title_cat')) {
            $updateData['title_cat'] = strip_tags($request->input('title_cat'));
        }
        if ($request->filled('title_bg')) {
            $updateData['title_bg'] = strip_tags($request->input('title_bg'));
        }
        if ($request->filled('title_gr')) {
            $updateData['title_gr'] = strip_tags($request->input('title_gr'));
        }

        if (!empty($updateData)) {
            DB::table('self')
                ->where('id', $self->id)
                ->update($updateData);
        }

        return redirect()->route('dashboard.self.index', ['lang' => app()->getLocale()])
            ->with('status', 'self translated successfully.');
    }

    public function destroy(SelfAssessment $self)
    {
        $self->delete();

        return redirect()->route('dashboard.self.index', ['lang' => app()->getLocale()])
            ->with('status', 'self deleted successfully.');
    }

    //SELF ASSESSMENT QUESTIONS

    public function createQuestion($lang, SelfAssessment $self)
    {
        return view('dashboard.self.self-create-question', compact('self'));
    }

    public function storeQuestion(Request $request, $lang, SelfAssessment $selfAssessment)
    {
        $request->validate([
            'question_en' => 'required',
            'answer' => 'required',
        ]);

        $self = new SelfQuestions;
        $self->question_en = $request->question_en;
        $self->self_id = $selfAssessment->id;
        $self->created_at = now();
        $self->updated_at = now();
        $self->answer = $request->answer;

        $translation = new Translations();
        $translation->key = 'self_' . $self->id . '_question';
        $translation->value = $request->question_en;
        $translation->section  = 'self';
        $translation->locale = 'en';
        $translation->section_id = $self->id;
        $translation->created_at = now();
        $translation->updated_at = now();
        $translation->save();

        $translation = new Translations();
        $translation->key = 'self_' . $self->id . '_answer';
        $translation->value = $request->answer;
        $translation->section  = 'self';
        $translation->locale = 'en';
        $translation->section_id = $self->id;
        $translation->created_at = now();
        $translation->updated_at = now();
        $translation->save();

        $options = [];
        if ($request->has('options')) {
            foreach ($request->options as $index => $option) {
                $options[] = $option;
                $translation = new Translations();
                $translation->key = 'self_' . $self->id . '_option_' . $index+1;
                $translation->value = $option;
                $translation->section  = 'self';
                $translation->locale = 'en';
                $translation->section_id = $self->id;
                $translation->created_at = now();
                $translation->updated_at = now();
                $translation->save();
            }
        }
        $self->options = implode(',', $options);

        $self->save();

        return redirect()->route('dashboard.self.index', ['lang' => app()->getLocale()])
            ->with('status', 'self question created successfully.');
    }

    public function editQuestion($lang, SelfQuestions $question)
    {
        $self = SelfAssessment::find($question->self_id);
        return view('dashboard.self.self-edit-question', compact('question', 'self'));
    }

    public function updateQuestion(Request $request, $lang, SelfQuestions $question)
    {

        $request->validate([
            'question_en' => 'required',
            'options' => 'required|array|min:1',
            'options.*' => 'required|string',
            'answer' => 'required|string',
        ]);

        $self = SelfAssessment::find($question->self_id);

        $question->question_en = $request->question_en;
        $question->answer = $request->answer;

        $questionExists = Translations::where('section', 'self')
            ->where('section_id', $self->id)
            ->where('locale', 'en')
            ->where('key', 'self_' . $self->id . '_question')
            ->exists();

        $answerExists = Translations::where('section', 'self')
            ->where('section_id', $self->id)
            ->where('locale', 'en')
            ->where('key', 'self_' . $self->id . '_answer')
            ->exists();


        if ($answerExists) {
            $answerExists = Translations::where('section', 'self')
            ->where('section_id', $self->id)
            ->where('locale', 'en')
            ->where('key', 'self_' . $self->id . '_answer')
            ->first();
            $answerExists->value = $request->answer;
            $answerExists->save();
        } else {
            $translation = new Translations();
            $translation->key = 'self_' . $self->id . '_answer';
            $translation->value = $request->answer;
            $translation->section  = 'self';
            $translation->locale = 'en';
            $translation->section_id = $self->id;
            $translation->created_at = now();
            $translation->updated_at = now();
            $translation->save();
        }

        if ($questionExists) {
            $questionExists = Translations::where('section', 'self')
            ->where('section_id', $self->id)
            ->where('locale', 'en')
            ->where('key', 'self_' . $self->id . '_question')
            ->first();
            $questionExists->value = $request->question_en;
            $questionExists->save();
        } else {
            $translation = new Translations();
            $translation->key = 'self_' . $self->id . '_question';
            $translation->value = $request->question_en;
            $translation->section  = 'self';
            $translation->locale = 'en';
            $translation->section_id = $self->id;
            $translation->created_at = now();
            $translation->updated_at = now();
            $translation->save();
        }

        $options = [];
        if ($request->has('options')) {
            foreach ($request->options as $index => $option) {
                $options[] = $option;
                $optionExists = Translations::where('section', 'self')
                    ->where('section_id', $self->id)
                    ->where('locale', 'en')
                    ->where('key', 'self_' . $self->id . '_option_' . $index+1)
                    ->exists();

                if ($optionExists) {
                    $optionExists = Translations::where('section', 'self')
                    ->where('section_id', $self->id)
                    ->where('locale', 'en')
                    ->where('key', 'self_' . $self->id . '_option_' . $index+1)
                    ->first();
                    $optionExists->value = $option;
                    $optionExists->save();
                } else {
                    $translation = new Translations();
                    $translation->key = 'self_' . $self->id . '_option_' . $index+1;
                    $translation->value = $option;
                    $translation->section  = 'self';
                    $translation->locale = 'en';
                    $translation->section_id = $self->id;
                    $translation->created_at = now();
                    $translation->updated_at = now();
                    $translation->save();
                }

            }

            $question->options = implode(',', $options);
        }


        $question->save();

        return redirect()->route('dashboard.self.index', ['lang' => app()->getLocale()])
            ->with('status', 'self question updated successfully.');
    }

    public function destroyQuestion($lang, SelfQuestions $question)
    {
        $question->delete();

        return redirect()->route('dashboard.self.index', ['lang' => app()->getLocale()])
            ->with('status', 'self deleted successfully.');
    }
}
