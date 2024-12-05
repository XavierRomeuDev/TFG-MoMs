<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Translations;

class PartnerController extends Controller
{
    /**
     * Display a listing of the partners.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $partners = Partner::all();
        return view('dashboard.partners.partners-list', ['partners' => $partners]);
    }

    public function partners()
    {
        $partners = Partner::all();
        return view('partners', compact('partners'));
    }

    public function create()
    {
        return view('dashboard.partners.partners-create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'country' => 'required',
            'website' => 'required|url',
            'description_en' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/partners/'), $filename);
            $validatedData['image'] = 'images/partners/' . $filename;
        }

        $partner = new Partner;
        $partner->name = $request->name;
        $partner->image = $validatedData['image'];
        $partner->country = $request->country;
        $partner->website = $request->website;
        $partner->description_en = $request->description_en;
        $partner->created_at = now();
        $partner->updated_at = now();
        $partner->save();

        $translation = new Translations();
        $translation->key = 'partner_name' . $partner->id;
        $translation->value = $partner->name;
        $translation->locale = 'en';
        $translation->section = 'partners';
        $translation->section_id = $partner->id;
        $translation->updated_at = now();
        $translation->created_at = now();
        $translation->save();

        $translation = new Translations();
        $translation->key = 'partner_description' . $partner->id;
        $translation->value = $partner->description_en;
        $translation->locale = 'en';
        $translation->section = 'partners';
        $translation->section_id = $partner->id;
        $translation->updated_at = now();
        $translation->created_at = now();
        $translation->save();

        $translation = new Translations();
        $translation->key = 'partner_country' . $partner->id;
        $translation->value = $partner->country;
        $translation->locale = 'en';
        $translation->section = 'partners';
        $translation->section_id = $partner->id;
        $translation->updated_at = now();
        $translation->created_at = now();
        $translation->save();

        return redirect()->route('dashboard.partners.index', ['lang' => app()->getLocale()])
            ->with('status', 'partner created successfully.');
    }

    public function edit($lang, Partner $partner)
    {
        return view('dashboard.partners.partners-edit', compact('partner'));
    }

    public function update(Request $request, $lang, Partner $partner)
    {
        $request->validate([
            'name' => 'nullable',
            'image' => 'nullable|max:128000',
            'country' => 'nullable',
            'website' => 'nullable',
            'description_en' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $validatedData['image'] = 'images/' . $filename;
            $validatedDataLang['image'] = 'images/' . $filename;
        }

        $partner->name = $request->input('name');
        $partner->country = $request->input('country');
        $partner->website = $request->input('website');
        $partner->description_en = $request->input('description_en');
        $partner->save();

        $translationName = Translations::where('section', 'partners')->where('section_id', $partner->id)->where('locale', 'en')->where('key', 'partner_name' . $partner->id)->exists();
        $translationDescription = Translations::where('section', 'partners')->where('section_id', $partner->id)->where('locale', 'en')->where('key', 'partner_description' . $partner->id)->exists();
        $translationCountry = Translations::where('section', 'partners')->where('section_id', $partner->id)->where('locale', 'en')->where('key', 'partner_country' . $partner->id)->exists();

        if ($translationName) {
            $translationName = Translations::where('section', 'partners')->where('section_id', $partner->id)->where('locale', 'en')->where('key', 'partner_name' . $partner->id)->first();
            $translationName->value = $partner->name;
            $translationName->update();
        }
        else {
            $translation = new Translations();
            $translation->key = 'partner_name' . $partner->id;
            $translation->value = $partner->name;
            $translation->locale = 'en';
            $translation->section = 'partners';
            $translation->section_id = $partner->id;
            $translation->updated_at = now();
            $translation->created_at = now();
            $translation->save();
        }

        if ($translationDescription) {
            $translationDescription = Translations::where('section', 'partners')->where('section_id', $partner->id)->where('locale', 'en')->where('key', 'partner_description' . $partner->id)->first();
            $translationDescription->value = $partner->description_en;
            $translationDescription->update();
        }
        else{
            $translation = new Translations();
            $translation->key = 'partner_description' . $partner->id;
            $translation->value = $partner->description_en;
            $translation->locale = 'en';
            $translation->section = 'partners';
            $translation->section_id = $partner->id;
            $translation->updated_at = now();
            $translation->created_at = now();
            $translation->save();

        }

        if ($translationCountry) {
            $translationCountry = Translations::where('section', 'partners')->where('section_id', $partner->id)->where('locale', 'en')->where('key', 'partner_country' . $partner->id)->first();
            $translationCountry->value = $partner->country;
            $translationCountry->update();
        }
        else {
            $translation = new Translations();
            $translation->key = 'partner_description' . $partner->id;
            $translation->value = $partner->country;
            $translation->locale = 'en';
            $translation->section = 'partners';
            $translation->section_id = $partner->id;
            $translation->updated_at = now();
            $translation->created_at = now();
            $translation->save();
        }


        return redirect()->route('dashboard.partners.index', ['lang' => app()->getLocale()])
            ->with('status', 'partner updated successfully.');
    }

    public function destroy($lang, Partner $partner)
    {
        $partner->delete();

        return redirect()->route('dashboard.partners.index', ['lang' => app()->getLocale()])
            ->with('status', 'partner deleted successfully.');
    }
}
