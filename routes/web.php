<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\GRVController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SelfController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\ResearchBookController;

Route::get('/', function () {
    return redirect(app()->getLocale() . '/home');
})->name('home');


Route::get('/{lang?}/home', function () {
    return view('home');
});

Route::get('/{lang?}/about', function () {
    return view('about');
});

Route::get('/{lang?}/partners', [PartnerController::class, 'partners'])->name('partners.index');

Route::get('/{lang?}/research-book', [ResearchBookController::class, 'research'])->name('research.index');

Route::get('/{lang?}/self-assessment', [SelfController::class, 'showForm'])->name('self.showForm');

Route::get('/{lang?}/forum', [ForumController::class, 'showApproved'])->name('forum.showApproved');

Route::get('/{lang?}/informative-pills', function () {
    return view('informative-pills');
});

Route::get('/{lang?}/informative-pills', [VideoController::class, 'videos'])->name('pills.index');

Route::get('/{lang?}/news', [NewController::class, 'news'])->name('news.index');
Route::get('/{lang?}/news/{new}', [NewController::class, 'showNew'])->name('news.detail');

Route::get('/{lang?}/contact', [GRVController::class, 'index']);

Route::get('/{lang?}/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/forum/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::resource('partners', PartnerController::class);
Route::resource('forum', ForumController::class);
Route::resource('tags', TagController::class);
Route::resource('pills', VideoController::class);
Route::resource('new', NewController::class);
Route::resource('self', SelfController::class);


Route::group(['prefix' => '{lang?}/dashboard'], function () {
    //PARTNERS
    Route::get('partners', [PartnerController::class, 'index'])->name('dashboard.partners.index');
    Route::get('partners/create', [PartnerController::class, 'create'])->name('dashboard.partners.create');
    Route::post('partners', [PartnerController::class, 'store'])->name('dashboard.partners.store');
    Route::get('partners/{partner}/edit', [PartnerController::class, 'edit'])->name('dashboard.partners.edit');
    Route::patch('partners/{partner}/edit', [PartnerController::class, 'update'])->name('dashboard.partners.update');
    Route::delete('partners/{partner}', [PartnerController::class, 'destroy'])->name('dashboard.partners.destroy');

    //FORUM
    Route::get('forum', [ForumController::class, 'index'])->name('dashboard.forum.index');
    Route::get('forum/{post}/review', [ForumController::class, 'reviewPost'])->name('dashboard.forum.review');
    Route::patch('forum/{post}/approve-or-deny', [ForumController::class, 'approveOrDeny'])->name('dashboard.forum.approveOrDeny');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{post}/edit', [ForumController::class, 'edit'])->name('forum.edit');
    Route::patch('/forum/{post}/edit', [ForumController::class, 'update'])->name('forum.update');
    Route::delete('/forum/{post}', [ForumController::class, 'delete'])->name('forum.delete');

    //TAGS
    Route::get('tags', [TagController::class, 'index'])->name('dashboard.tags.index');
    Route::get('tags/create', [TagController::class, 'createTag'])->name('dashboard.tags.create');
    Route::post('tags/store-tag', [TagController::class, 'storeTag'])->name('tags.storeTag');
    Route::get('tags/{tag}/edit', [TagController::class, 'edit'])->name('dashboard.tags.edit');
    Route::patch('tags/{tag}/edit', [TagController::class, 'update'])->name('dashboard.tags.update');
    Route::delete('tags/{tag}', [TagController::class, 'destroy'])->name('dashboard.tags.destroy');

    //INFORMATIVE PILLS
    Route::get('pills', [VideoController::class, 'index'])->name('dashboard.pills.index');
    Route::get('pills/create', [VideoController::class, 'create'])->name('dashboard.pills.create');
    Route::post('pills/store-pill', [VideoController::class, 'store'])->name('pills.store');
    Route::get('pills/{pill}/edit', [VideoController::class, 'edit'])->name('dashboard.pills.edit');
    Route::patch('pills/{pill}/edit', [VideoController::class, 'update'])->name('dashboard.pills.update');
    Route::delete('pills/{pill}', [VideoController::class, 'destroy'])->name('dashboard.pills.destroy');

    //NEWS
    Route::get('news', [NewController::class, 'index'])->name('dashboard.news.index');
    Route::get('news/create', [NewController::class, 'create'])->name('dashboard.news.create');
    Route::post('news', [NewController::class, 'store'])->name('dashboard.news.store');
    Route::get('news/{new}/translate', [NewController::class, 'translate'])->name('dashboard.news.translate');
    Route::patch('news/{new}/translate', [NewController::class, 'saveTranslations'])->name('dashboard.news.saveTranslations');
    Route::get('news/{new}/edit', [NewController::class, 'edit'])->name('dashboard.news.edit');
    Route::patch('news/{new}/edit', [NewController::class, 'update'])->name('dashboard.news.update');
    Route::delete('news/{new}', [NewController::class, 'destroy'])->name('dashboard.news.destroy'); // Add this line

    //NEWSLETTERS
    Route::get('newsletters', [NewsletterController::class, 'index'])->name('dashboard.newsletters.index');
    Route::get('newsletters/create', [NewsletterController::class, 'create'])->name('dashboard.newsletters.create');
    Route::post('newsletters', [NewsletterController::class, 'store'])->name('dashboard.newsletters.store');
    Route::get('newsletters/{newsletter}/edit', [NewsletterController::class, 'edit'])->name('dashboard.newsletters.edit');
    Route::patch('newsletters/{newsletter}/edit', [NewsletterController::class, 'update'])->name('dashboard.newsletters.update');
    Route::delete('newsletters/{newsletter}', [NewsletterController::class, 'destroy'])->name('dashboard.newsletters.destroy');

    //SELF ASSESSMENT
    Route::get('self', [SelfController::class, 'index'])->name('dashboard.self.index');
    Route::get('self/create', [SelfController::class, 'create'])->name('dashboard.self.create');
    Route::post('self', [SelfController::class, 'store'])->name('dashboard.self.store');
    Route::get('self/{self}/edit', [SelfController::class, 'edit'])->name('dashboard.self.edit');
    Route::patch('self/{self}/edit', [SelfController::class, 'update'])->name('dashboard.self.update');
    Route::delete('self/{self}', [SelfController::class, 'destroy'])->name('dashboard.self.destroy'); // Updated route name

    Route::get('self/{self}/create-question', [SelfController::class, 'createQuestion'])->name('dashboard.self.createQuestion');
    Route::post('self-question/{selfAssessment}', [SelfController::class, 'storeQuestion'])->name('dashboard.self.storeQuestion');
    Route::get('self-question/{question}/edit', [SelfController::class, 'editQuestion'])->name('dashboard.self.editQuestion');
    Route::patch('self-question/{question}/edit', [SelfController::class, 'updateQuestion'])->name('dashboard.self.updateQuestion');
    Route::delete('self-question/{question}', [SelfController::class, 'destroyQuestion'])->name('self.destroyQuestion');

    //RESEARCH BOOK
    Route::get('research-book', [ResearchBookController::class, 'index'])->name('dashboard.research-book.index');
    Route::get('research-book/create', [ResearchBookController::class, 'create'])->name('dashboard.research-book.create');
    Route::post('research-book', [ResearchBookController::class, 'store'])->name('dashboard.research-book.store');
    Route::get('research-book/{research}/edit', [ResearchBookController::class, 'edit'])->name('dashboard.research-book.edit');
    Route::patch('research-book/{research}/edit', [ResearchBookController::class, 'update'])->name('dashboard.research-book.update');
    Route::delete('research-book/{research}', [ResearchBookController::class, 'destroy'])->name('dashboard.research-book.destroy');
    
    //TRANSLATIONS
    Route::get('translations', [TranslationController::class, 'index'])->name('dashboard.translations.index');
    Route::get('translations/create', [TranslationController::class, 'create'])->name('dashboard.translations.create');
    Route::post('translations/create', [TranslationController::class, 'store'])->name('dashboard.translations.store');
    Route::get('translations/{translation}/translate', [TranslationController::class, 'translate'])->name('dashboard.translations.translate');
    Route::patch('translations/{translation}/translate', [TranslationController::class, 'translateUpdate'])->name('dashboard.translations.translateUpdate');
    Route::delete('translations/{translation}', [TranslationController::class, 'destroy'])->name('dashboard.translations.destroy');

});
Route::middleware('auth')->group(function () {
    Route::get('/{lang?}/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/{lang?}/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//RECAPTCHA
Route::post('validate-recaptcha-v3', [GRVController::class, 'validateByReCaptchaV3']);

require __DIR__ . '/auth.php';
