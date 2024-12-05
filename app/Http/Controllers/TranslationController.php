<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Translations;
use App\Models\Partner;
use Illuminate\Validation\Rule;
use SebastianBergmann\Diff\Diff;
use App\Models\SelfAssessment;
use App\Models\SelfQuestions;

class TranslationController extends Controller
{
    public function index()
    {
        return view('dashboard.translations.translations-list');
    }

    public function create()
    {
        return view('dashboard.translations.translation-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required',
            'value' => 'required',
            'section' => 'required',
        ]);

        if (Translations::where('key', $request->get('key'))->exists()) {
            return redirect()->back()->with('error', 'Key already exists');
        }

        $translation = new Translations();
        $translation->key = $request->get('key');
        $translation->value = $request->get('value');
        $translation->locale = 'en';
        $translation->section = $request->get('section');
        $translation->created_at = now();
        $translation->updated_at = now();
        $translation->section_id = $translation->section_id;
        $translation->save();

        return view('dashboard.translations.translations-list');
    }

    public function translate($lang, Translations $translation)
    {
        return view('dashboard.translations.translation-translate', compact('translation'));
    }



    public function translateUpdate(Request $request, $lang, Translations $translation)
    {
        $request->validate([
            'translations' => 'required|array',
            'key' => 'required',
        ]);

        foreach ($request->get('translations') as $lang => $value) {
            // Validate each translation's value
            if (empty($value)) {
                if (Translations::where('key', $request->get('key'))->where('locale', $lang)->exists()) {
                    Translations::where('key', $request->get('key'))->where('locale', $lang)->delete();
                }
                continue;
            }

            // Special handling for English descriptions linked to the News model
            if ($lang === 'en' && Translations::where('key', $request->get('key'))->where('locale', $lang)->exists()) {
                if ($translation->key === 'new_description' . $translation->section_id) {
                    News::where('id', $translation->section_id)->update([
                        'description_en' => $value,
                    ]);
                }
                if ($translation->key === 'new_title' . $translation->section_id) {
                    News::where('id', $translation->section_id)->update([
                        'title' => $value,
                    ]);
                }
            }

            //Special handling for English descriptions linked to the Partner model
            if ($lang === 'en' && Translations::where('key', $request->get('key'))->where('locale', $lang)->exists()) {
                if ($translation->key === 'partner_description' . $translation->section_id) {
                    Partner::where('id', $translation->section_id)->update([
                        'description_en' => $value,
                    ]);
                }
                if ($translation->key === 'partner_name' . $translation->section_id) {
                    Partner::where('id', $translation->section_id)->update([
                        'name' => $value,
                    ]);
                }
                if ($translation->key === 'partner_country' . $translation->section_id) {
                    Partner::where('id', $translation->section_id)->update([
                        'country' => $value,
                    ]);
                }
            }

            // Special handling for English titles linked to the SelfAssessment model
            if ($lang === 'en' && Translations::where('key', $request->get('key'))->where('locale', $lang)->exists()) {
                if ($translation->key === 'self_title' . $translation->section_id) {
                    SelfAssessment::where('id', $translation->section_id)->update([
                        'title_en' => $value,
                    ]);
                }
            }

            // Special handling for English questions linked to the SelfAssessment Question model
            if ($lang === 'en' && Translations::where('key', $request->get('key'))->where('locale', $lang)->exists()) {
                if ($translation->key === 'self_' . $translation->section_id . '_question') {
                    SelfQuestions::where('self_id', $translation->section_id)->update([
                        'question_en' => $value,
                    ]);
                }

                if ($translation->key === 'self_' . $translation->section_id . '_answer') {
                    SelfQuestions::where('self_id', $translation->section_id)->update([
                        'answer' => $value,
                    ]);
                }
            }

            // Update existing translations or create new ones
            $existingTranslation = Translations::where('key', $request->get('key'))->where('locale', $lang)->first();
            if ($existingTranslation) {
                $existingTranslation->update(['value' => $value]);
            } else {
                Translations::create([
                    'key' => $request->get('key'),
                    'value' => $value,
                    'locale' => $lang,
                    'section' => $translation->section,
                    'section_id' => $translation->section_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Redirect or return response
        return redirect()->route('dashboard.translations.index', ['lang' => app()->getLocale()])
            ->with('status', 'Translations updated successfully.');
    }

    public function destroy($lang, Translations $translation)
    {
        $translation->delete();

        return redirect()->route('dashboard.translations.index', ['lang' => app()->getLocale()])
            ->with('status', 'Translation deleted successfully.');
    }
}
