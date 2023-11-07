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

        Route::get('user/auto-login/{id}', [AdminController::class, 'autoLogin'])->name('auto.login');

          //Profile
          Route::get('/profile', [AdminController::class, 'Profile'])->name('profile');
          Route::post('/profile',[AdminController::class,'profileUpdate'])->name('profile.update');

          //password
          Route::get('/change/password',[AdminController::class,'passwordChange'])->name('password');
          Route::post('password',[AdminController::class,'passwordUpdate'])->name('password.update');

          //Referral
          Route::get('/referrals', [ReferralController::class, 'Index'])->name('referral');
          Route::post('/referral/levels', [ReferralController::class, 'levelStore'])->name('levels.store');
          Route::post('/deposit/commission', [ReferralController::class, 'commissionUpdate'])->name('commission.update');

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
          Route::get('/allusers', [UserController::class, 'Index'])->name('allusers');
          Route::get('/activeusers', [UserController::class, 'activeUsers'])->name('activeusers');
          Route::get('/pendingusers', [UserController::class, 'pendingUsers'])->name('pendingusers');
          Route::get('/blockedusers', [UserController::class, 'blockedUsers'])->name('blockedusers');
          Route::get('/emailunverified', [UserController::class, 'emailUnverifiedUsers'])->name('emailunverified');
          Route::get('/smsunverified', [UserController::class, 'smsUnverifiedUsers'])->name('smsunverified');

          Route::get('users/{id}', [UserController::class, 'userEdit'])->name('user.edit');
          Route::post('users/{id}', [UserController::class, 'userUpdate'])->name('user.update');
          Route::post('addbalance/{id}', [UserController::class, 'addBalance'])->name('user.addbalance');
          Route::post('subbalance/{id}', [UserController::class, 'subBalance'])->name('user.subbalance');

        //Subscribers
        Route::get('/subscriber', [SubscriberController::class, 'index'])->name('subscriber');
        Route::get('/subscriber/mail', [SubscriberController::class, 'mail'])->name('subscriber.mail');
        Route::post('/subscriber/mail', [SubscriberController::class, 'sendMail'])->name('subscriber.mail.send');

        // DEPOSIT SYSTEM
        Route::get('deposit', [DepositController::class, 'deposit'])->name('deposit.list');
        Route::get('deposit/pending', [DepositController::class, 'pending'])->name('deposit.pending');
        Route::get('deposit/rejected', [DepositController::class, 'rejected'])->name('deposit.rejected');
        Route::get('deposit/approved', [DepositController::class, 'approved'])->name('deposit.approved');
        Route::post('deposit/reject', [DepositController::class, 'reject'])->name('deposit.reject');
        Route::post('deposit/approve', [DepositController::class, 'approve'])->name('deposit.approve');
        Route::get('deposit/{scope}/search', [DepositController::class, 'search'])->name('deposit.search');

        // Deposit Gateway
        Route::get('deposit/gateway', [GatewayController::class, 'index'])->name('deposit.gateway.index');
        Route::get('deposit/gateway/edit/{code}', [GatewayController::class, 'edit'])->name('deposit.gateway.edit');
        Route::post('deposit/gateway/update/{code}', [GatewayController::class, 'update'])->name('deposit.gateway.update');
        Route::post('deposit/gateway/remove/{code}', [GatewayController::class, 'remove'])->name('deposit.gateway.remove');
        Route::post('deposit/gateway/activate', [GatewayController::class, 'activate'])->name('deposit.gateway.activate');
        Route::post('deposit/gateway/deactivate', [GatewayController::class, 'deactivate'])->name('deposit.gateway.deactivate');

        // Manual Methods
        Route::get('deposit/gateway/manual', [ManualGatewayController::class, 'index'])->name('deposit.manual.index');
        Route::get('deposit/gateway/manual/new', [ManualGatewayController::class, 'create'])->name('deposit.manual.create');
        Route::post('deposit/gateway/manual/new', [ManualGatewayController::class, 'store'])->name('deposit.manual.store');
        Route::get('deposit/gateway/manual/edit/{id}', [ManualGatewayController::class, 'edit'])->name('deposit.manual.edit');
        Route::post('deposit/gateway/manual/update/{id}', [ManualGatewayController::class, 'update'])->name('deposit.manual.update');
        Route::post('deposit/gateway/manual/activate', [ManualGatewayController::class, 'activate'])->name('deposit.manual.activate');
        Route::post('deposit/gateway/manual/deactivate', [ManualGatewayController::class, 'deactivate'])->name('deposit.manual.deactivate');

        // Withdraw Method
        Route::get('withdraw/method/', [WithdrawMethodController::class, 'methods'] )->name('withdraw.method.methods');
        Route::get('withdraw/method/new', [WithdrawMethodController::class, 'create'] )->name('withdraw.method.create');
        Route::post('withdraw/method/store', [WithdrawMethodController::class, 'store'] )->name('withdraw.method.store');
        Route::get('withdraw/method/edit/{id}', [WithdrawMethodController::class, 'edit'] )->name('withdraw.method.edit');
        Route::post('withdraw/method/edit/{id}', [WithdrawMethodController::class, 'update'] )->name('withdraw.method.update');
        Route::post('withdraw/method/activate', [WithdrawMethodController::class, 'activate'] )->name('withdraw.method.activate');
        Route::post('withdraw/method/deactivate', [WithdrawMethodController::class, 'deactivate'] )->name('withdraw.method.deactivate');

        // WITHDRAW SYSTEM
        Route::get('withdraw/pending', [WithdrawalController::class, 'pending'] )->name('withdraw.pending');
        Route::get('withdraw/approved', [WithdrawalController::class, 'approved'] )->name('withdraw.approved');
        Route::get('withdraw/rejected', [WithdrawalController::class, 'rejected'] )->name('withdraw.rejected');
        Route::get('withdraw/log', [WithdrawalController::class, 'log'] )->name('withdraw.log');
        Route::get('withdraw/{scope}/search', [WithdrawalController::class, 'search'] )->name('withdraw.search');
        Route::post('withdraw/approve', [WithdrawalController::class, 'approve'] )->name('withdraw.approve');
        Route::post('withdraw/reject', [WithdrawalController::class, 'reject'] )->name('withdraw.reject');

        // Report
        Route::get('report/transaction', [ReportController::class, 'transaction'])->name('report.transaction');
        Route::get('report/referral/commission', [ReportController::class, 'referral'])->name('report.referral');
        Route::get('report/interest', [ReportController::class, 'interest'])->name('report.interest');
        Route::get('report/investment', [ReportController::class, 'investment'])->name('report.investment');

        //Basic Settings

          //Basic
          Route::get('settings/basic', [BasicSettingController::class, 'basic'])->name('settings');
          Route::post('settings/basic', [BasicSettingController::class, 'basicUpdate'])->name('settings.basic');

          //logo
          Route::get('settings/logo-favicon', [BasicSettingController::class, 'logo_favicon'])->name('logo');
          Route::post('settings/logo-favicon', [BasicSettingController::class, 'logo_favicon_update'])->name('settings.logo');


        Route::get('settings/home-version', [BasicSettingController::class, 'homeversion'])->name('settings.home.version');
        Route::post('settings/home-version/post', [BasicSettingController::class, 'updatehomeversion'])->name('settings.home.version.update');

          //Contact
          Route::get('settings/contact', [BasicSettingController::class, 'contact'])->name('contact');
          Route::post('settings/contact', [BasicSettingController::class, 'contactUpdate'])->name('settings.contact');

          //Breadcrumb
          Route::get('settings/breadcrumb', [BasicSettingController::class, 'breadcrumb'])->name('breadcrumb');
          Route::post('settings/breadcrumb', [BasicSettingController::class, 'breadcrumbUpdate'])->name('settings.breadcrumb');

        //   //Social
          Route::get('settings/social/create', [SocialController::class, 'index'])->name('social.create');
          Route::post('settings/social/create', [SocialController::class, 'store'])->name('settings.social.store');
          Route::get('settings/social/edit/{id}', [SocialController::class, 'edit'])->name('settings.social.edit');
          Route::post('settings/social/edit/{id}', [SocialController::class, 'update'])->name('settings.social.update');
          Route::delete('/social/destroy/{id}', [SocialController::class, 'destroy'])->name('settings.social.destroy');

          //Footer
          Route::get('settings/footer', [BasicSettingController::class, 'footer'])->name('footer');
          Route::post('settings/footer', [BasicSettingController::class, 'footerUpdate'])->name('settings.footer');

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
          Route::get('home/about', [SettingExtraController::class, 'about'])->name('about');
          Route::post('home/about', [SettingExtraController::class, 'aboutUpdate'])->name('about.update');

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
          Route::get('home/privacy', [SettingExtraController::class, 'Privacy'])->name('privacy');
          Route::post('home/privacy', [SettingExtraController::class, 'privacyUpdate'])->name('privacy.update');

          //Terms
          Route::get('home/terms', [SettingExtraController::class, 'Terms'])->name('terms');
          Route::post('home/terms', [SettingExtraController::class, 'termsUpdate'])->name('terms.update');

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


