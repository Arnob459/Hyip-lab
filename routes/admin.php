<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Admin

Route::name('admin.')->group(function() {

    Route::middleware(['admin.guest'])->group(function () {
        //Your routes here
        Route::get('/login', [Auth\LoginController ::class, 'showLoginForm'])->name('login');
        Route::post('/login', [Auth\LoginController ::class, 'login'])->name('signin');
    });
    Route::middleware(['admin'])->group(function () {
        //Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

          //Profile
          Route::get('/profile', [AdminController::class, 'Profile'])->name('profile');
          Route::post('/profile',[AdminController::class,'profileUpdate'])->name('profile.update');

          //password
          Route::get('/change/password',[AdminController::class,'passwordChange'])->name('password');
          Route::post('password',[AdminController::class,'passwordUpdate'])->name('password.update');

        //   Route::get('profile', 'AdminController@profile')->name('profile');
        //   Route::post('profile', 'AdminController@profileUpdate')->name('profile.update');
        //   Route::post('password', 'AdminController@passwordUpdate')->name('password.update');
        //   Route::get('change/password', 'AdminController@passwordChange')->name('change.password');

          //Referral
          Route::get('/referrals', [ReferralController::class, 'Index'])->name('referral');
          Route::post('/referral/levels', [ReferralController::class, 'levelStore'])->name('levels.store');
          Route::post('/deposit/commission', [ReferralController::class, 'commissionUpdate'])->name('commission.update');

        //   Route::get('referrals', 'ReferralController@index')->name('referrals');
        //   Route::post('referrals', 'ReferralController@create')->name('referrals');
        //   Route::put('referral-commission', 'ReferralController@refCom')->name('referral.com');

          //plan
          Route::get('/plan', [PlanController::class, 'Index'])->name('plan');
          Route::get('/plan/create', [PlanController::class, 'planCreate'])->name('plan.create');
          Route::post('/plan/create', [PlanController::class, 'planStore'])->name('plan.store');
          Route::get('plan/{id}/edit', [PlanController::class, 'planEdit'])->name('plan.edit');
          Route::post('plan/{id}/edit', [PlanController::class, 'planUpdate'])->name('plan.update');


          //Rewards
          Route::get('/reward', [RewardsController::class, 'Index'])->name('rewards');
          Route::get('reward/{id}/edit', [RewardsController::class, 'rewardEdit'])->name('reward.edit');
          Route::post('reward/{id}/edit', [RewardsController::class, 'rewardUpdate'])->name('reward.update');

          Route::get('reward/{id}', [RewardsController::class, 'levelList'])->name('reward.level.list');
          Route::get('reward-edit/{id}', [RewardsController::class, 'levelEdit'])->name('reward.level.edit');
          Route::put('reward-update', [RewardsController::class, 'levelUpdate'])->name('reward.level.update');
          Route::delete('/reward/destroy/{id}', [RewardsController::class, 'destroy'])->name('reward.destroy');


          //Manage User
          Route::get('/allusers', [UserManageController::class, 'Index'])->name('allusers');
          Route::get('/activeusers', [UserManageController::class, 'activeUsers'])->name('activeusers');
          Route::get('/pendingusers', [UserManageController::class, 'pendingUsers'])->name('pendingusers');
          Route::get('/blockedusers', [UserManageController::class, 'blockedUsers'])->name('blockedusers');
          Route::get('/emailunverified', [UserManageController::class, 'emailUnverifiedUsers'])->name('emailunverified');
          Route::get('/smsunverified', [UserManageController::class, 'smsUnverifiedUsers'])->name('smsunverified');

          Route::get('users/{id}', [UserManageController::class, 'userEdit'])->name('user.edit');
          Route::post('users/{id}', [UserManageController::class, 'userUpdate'])->name('user.update');


          //Subscribers
          Route::get('/subscriber', [SubscriberController::class, 'Index'])->name('subscribers');
          Route::get('/subscriber/mail', [SubscriberController::class, 'Mail'])->name('subscribers.mail');
          Route::post('/subscriber/mail', [SubscriberController::class, 'sendEmail'])->name('subscribers.mail.send');

          //Basic Settings

          //Basic
          Route::get('settings/basic', [BasicSettingsController::class, 'basicSettings'])->name('settings');
          Route::post('settings/basic', [BasicSettingsController::class, 'basicUpdate'])->name('basic.update');

          //logo
          Route::get('settings/logo-favicon', [BasicSettingsController::class, 'logo'])->name('logo');
          Route::post('settings/logo-favicon', [BasicSettingsController::class, 'logoUpdate'])->name('logo.update');


          //Contact
          Route::get('settings/contact', [BasicSettingsController::class, 'Contact'])->name('contact');
          Route::post('settings/contact', [BasicSettingsController::class, 'contactUpdate'])->name('contact.update');

          //Breadcrumb
          Route::get('settings/breadcrumb', [BasicSettingsController::class, 'Breadcrumb'])->name('breadcrumb');
          Route::post('settings/breadcrumb', [BasicSettingsController::class, 'breadcrumbUpdate'])->name('breadcrumb.update');

          //Social
          Route::get('settings/social/create', [BasicSettingsController::class, 'socialCreate'])->name('social.create');
          Route::post('settings/social/create', [BasicSettingsController::class, 'socialStore'])->name('social.store');
          Route::get('settings/social/edit/{id}', [BasicSettingsController::class, 'socialEdit'])->name('social.edit');
          Route::post('settings/social/edit/{id}', [BasicSettingsController::class, 'socialUpdate'])->name('social.update');
          Route::delete('/social/destroy/{id}', [BasicSettingsController::class, 'destroy'])->name('social.destroy');


          //Footer
          Route::get('settings/footer', [BasicSettingsController::class, 'Footer'])->name('footer');
          Route::post('settings/footer', [BasicSettingsController::class, 'footerUpdate'])->name('footer.update');

          //End Basic Settings


          //Home Page

          //Banner
          Route::get('home/banner', [BannerController::class, 'Banner'])->name('banner');
          Route::post('home/banner', [BannerController::class, 'bannerUpdate'])->name('banner.update');
          //Slider
          Route::get('home/slider', [SliderController::class, 'Slider'])->name('slider');
          Route::get('home/slider/create', [SliderController::class, 'sliderCreate'])->name('slider.create');
          Route::post('home/slider/create', [SliderController::class, 'sliderStore'])->name('slider.store');
          Route::get('home/slider/edit/{id}', [SliderController::class, 'sliderEdit'])->name('slider.edit');
          Route::post('home/slider/edit/{id}', [SliderController::class, 'sliderUpdate'])->name('slider.update');
          Route::delete('/slider/destroy/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');


          //Services
          Route::get('home/services', [ServiceController::class, 'Service'])->name('services');
          Route::post('home/services', [ServiceController::class, 'serviceSectionUpdate'])->name('serviceupdate');

          Route::get('home/services/create', [ServiceController::class, 'servicesCreate'])->name('services.create');
          Route::post('home/services/create', [ServiceController::class, 'servicesStore'])->name('services.store');
          Route::get('home/services/edit/{id}', [ServiceController::class, 'servicesEdit'])->name('services.edit');
          Route::post('home/services/edit/{id}', [ServiceController::class, 'servicesUpdate'])->name('services.update');
          Route::delete('/services/destroy/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');


          //About
          Route::get('home/about', [AboutController::class, 'About'])->name('about');
          Route::post('home/about', [AboutController::class, 'aboutUpdate'])->name('about.update');

          //Counter
          Route::get('home/counter', [CounterController::class, 'Counter'])->name('counter');
          Route::post('home/counter', [CounterController::class, 'counterSectionUpdate'])->name('countersection.update');

          Route::get('home/counter/create', [CounterController::class, 'counterCreate'])->name('counter.create');
          Route::post('home/counter/create', [CounterController::class, 'counterStore'])->name('counter.store');
          Route::get('home/counter/edit/{id}', [CounterController::class, 'counterEdit'])->name('counter.edit');
          Route::post('home/counter/edit/{id}', [CounterController::class, 'counterUpdate'])->name('counter.update');
          Route::delete('/counter/destroy/{id}', [CounterController::class, 'destroy'])->name('counter.destroy');


          //Work
          Route::get('home/work', [WorkController::class, 'Work'])->name('work');
          Route::post('home/work', [WorkController::class, 'workSectionUpdate'])->name('worksection.update');

          Route::get('home/work/create', [WorkController::class, 'workCreate'])->name('work.create');
          Route::post('home/work/create', [WorkController::class, 'workStore'])->name('work.store');
          Route::get('home/work/edit/{id}', [WorkController::class, 'workEdit'])->name('work.edit');
          Route::post('home/work/edit/{id}', [WorkController::class, 'workUpdate'])->name('work.update');
          Route::delete('/work/destroy/{id}', [WorkController::class, 'destroy'])->name('work.destroy');


          //Faq
          Route::get('home/faq', [FaqController::class, 'Faq'])->name('faq');
          Route::post('home/faq', [FaqController::class, 'faqSectionUpdate'])->name('faqsection.update');

          Route::get('home/faq/create', [FaqController::class, 'faqCreate'])->name('faq.create');
          Route::post('home/faq/create', [FaqController::class, 'faqStore'])->name('faq.store');
          Route::get('home/faq/edit/{id}', [FaqController::class, 'faqEdit'])->name('faq.edit');
          Route::post('home/faq/edit/{id}', [FaqController::class, 'faqUpdate'])->name('faq.update');
          Route::delete('/faq/destroy/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');

          //Why Choose us
          Route::get('home/choose', [ChooseUsController::class, 'Choose'])->name('choose');
          Route::post('home/choose', [ChooseUsController::class, 'chooseSectionUpdate'])->name('choosesection.update');

          Route::get('home/choose/create', [ChooseUsController::class, 'chooseCreate'])->name('choose.create');
          Route::post('home/choose/create', [ChooseUsController::class, 'chooseStore'])->name('choose.store');
          Route::get('home/choose/edit/{id}', [ChooseUsController::class, 'chooseEdit'])->name('choose.edit');
          Route::post('home/choose/edit/{id}', [ChooseUsController::class, 'chooseUpdate'])->name('choose.update');
          Route::delete('/choose/destroy/{id}', [ChooseUsController::class, 'destroy'])->name('choose.destroy');


          //Testimonial
          Route::get('home/testimonial', [TestimonialController::class, 'Testimonial'])->name('testimonial');
          Route::post('home/testimonial', [TestimonialController::class, 'testimonialSectionUpdate'])->name('testimonialsection.update');

          Route::get('home/testimonial/create', [TestimonialController::class, 'testimonialCreate'])->name('testimonial.create');
          Route::post('home/testimonial/create', [TestimonialController::class, 'testimonialStore'])->name('testimonial.store');
          Route::get('home/testimonial/edit/{id}', [TestimonialController::class, 'testimonialEdit'])->name('testimonial.edit');
          Route::post('home/testimonial/edit/{id}', [TestimonialController::class, 'testimonialUpdate'])->name('testimonial.update');
          Route::delete('/testimonial/destroy/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');


          //Blog
          Route::get('home/blog', [BlogController::class, 'Blog'])->name('blog');
          Route::post('home/blog', [BlogController::class, 'blogSectionUpdate'])->name('blogsection.update');

          Route::get('home/blog/create', [BlogController::class, 'blogCreate'])->name('blog.create');
          Route::post('home/blog/create', [BlogController::class, 'blogStore'])->name('blog.store');
          Route::get('home/blog/edit/{id}', [BlogController::class, 'blogEdit'])->name('blog.edit');
          Route::post('home/blog/edit/{id}', [BlogController::class, 'blogUpdate'])->name('blog.update');
          Route::delete('/blog/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

          //Title and Subtitle
          Route::get('home/title-subtitle', [TitleSubtitleController::class, 'titleSubtitle'])->name('titleSubtitle');
          Route::post('home/title-subtitle', [TitleSubtitleController::class, 'titleSubtitleUpdate'])->name('titleSubtitle.update');

          //privacy
          Route::get('home/privacy', [PrivacyController::class, 'Privacy'])->name('privacy');
          Route::post('home/privacy', [PrivacyController::class, 'privacyUpdate'])->name('privacy.update');

          //Terms
          Route::get('home/terms', [TermsController::class, 'Terms'])->name('terms');
          Route::post('home/terms', [TermsController::class, 'termsUpdate'])->name('terms.update');

          //End Home

          //Language Manager
          Route::get('language', [LanguageController::class, 'Language'])->name('language');
          Route::post('language/create', [LanguageController::class, 'languageStore'])->name('language.store');
          Route::get('language/edit/{id}', [LanguageController::class, 'languageEdit'])->name('language.edit');
          Route::put('language/update', [LanguageController::class, 'languageUpdate'])->name('language.update');
          Route::delete('/language/destroy/{id}', [LanguageController::class, 'destroy'])->name('language.destroy');


          Route::get('language/view/{id}', [LanguageController::class, 'keywordEdit'])->name('keyword.edit');
          Route::put('language/view/update', [LanguageController::class, 'KeywordUpdate'])->name('keyword.update');
          Route::post('language/keyword/create', [LanguageController::class, 'keywordStore'])->name('keyword.store');
          Route::delete('/keyword/destroy/{id}', [LanguageController::class, 'destroyKeyword'])->name('keyword.destroy');
          Route::get('keyword/import/{id}', [LanguageController::class, 'keywordImport'])->name('keyword.import');






          //SMS Manager
          //Api
          Route::get('sms-template/global', [SmsController::class, 'smsApi'])->name('sms.api');
          Route::post('sms-template/global', [SmsController::class, 'smsApiUpdate'])->name('sms.api.update');

          //Templete
          Route::get('sms-template/index', [SmsController::class, 'smsTemplete'])->name('sms.templete');
          Route::get('sms-template/edit/{id}', [SmsController::class, 'smsTempleteEdit'])->name('sms.templete.edit');
          Route::post('sms-template/edit/{id}', [SmsController::class, 'smsTempleteUpdate'])->name('sms.templete.update');

          //Test sms
          Route::get('sms-template/test', [SmsController::class, 'smsTest'])->name('sms.test');

        //logout
        Route::get('/logout', [Auth\LoginController ::class, 'logout'])->name('logout');
    });

});


