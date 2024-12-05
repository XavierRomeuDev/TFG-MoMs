@php
    $locale = app()->getLocale();
    $translations  = \App\Models\Translations::where('locale', $locale)->get()->select('key', 'value')->pluck('value', 'key')->toArray();
    $translations_en  = \App\Models\Translations::where('locale', "en")->get()->select('key', 'value')->pluck('value', 'key')->toArray();
@endphp


<div class="container">
    <div class="ag-timeline_title-box">
        <h4 class="top">
            <i class="bi bi-caret-right-fill"></i>
            <i class="bi bi-caret-right-fill"></i>
            <i class="bi bi-caret-right-fill"></i>
            {{ __('tl_title') }}
            <i class="bi bi-caret-left-fill"></i>
            <i class="bi bi-caret-left-fill"></i>
            <i class="bi bi-caret-left-fill"></i>
        </h4>
    </div>
    <div class="timeline-container">
        <div class="timeline-event" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="500">
            <div class="event-row timeline-row">
                <!-- Event Image -->
                <img src="/images/timeline/MoMs_IstitutoSordiTorino.jpg" alt="...">
                <!-- Event Content -->
                <div class="card-body">
                    <span class="timeline-slider-date"><i class="fas fa-calendar-alt"></i>
                        {!!strip_tags($translations['tl_date1'] ?? $translations_en['tl_date1'])!!}</span>
                    <h4 class="timeline-slider-title">{!!strip_tags($translations['tl_first'] ?? $translations_en['tl_first'])!!}</h4>
                </div>

            </div>
        </div>
        <div class="timeline-event" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="500">
            <div class="event-row timeline-row">
                <!-- Event Image -->
                <img src="/images/timeline/LTTA in Sevilla.jpg"
                    class="ag-timeline-card_img" alt="" />
                <!-- Event Content -->
                <div class="card-body">
                    <span class="timeline-slider-date"><i class="fas fa-calendar-alt"></i>
                        {!!strip_tags($translations['tl_date2'] ?? $translations_en['tl_date2'])!!}</span>
                    <h4 class="timeline-slider-title">{!!strip_tags($translations['tl_second'] ?? $translations_en['tl_second'])!!}</h4>
                </div>
            </div>
        </div>
        <div class="timeline-event" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="500">
            <div class="event-row timeline-row">
                <!-- Event Image -->
                <!-- Event Content -->
                <img src="/images/timeline/Second transnational meeting in Sevilla.jpg"
                    class="ag-timeline-card_img" alt="" />
                <div class="card-body">
                    <span class="timeline-slider-date"><i class="fas fa-calendar-alt"></i>
                        {!!strip_tags($translations['tl_date3'] ?? $translations_en['tl_date3'])!!}</span>
                    <h4 class="timeline-slider-title">{!!strip_tags($translations['tl_third'] ?? $translations_en['tl_third'])!!}</h4>
                </div>
            </div>
        </div>
        <div class="timeline-event" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="500">
            <div class="event-row timeline-row">
                <!-- Event Image -->
                <img src="/images/timeline/Final Transnational Meeting in Turin.jpg"
                    class="ag-timeline-card_img" alt="" />
                <!-- Event Content -->
                <div class="card-body">
                    <span class="timeline-slider-date"><i class="fas fa-calendar-alt"></i>
                        {!!strip_tags($translations['tl_date4'] ?? $translations_en['tl_date4'])!!}</span>
                    <h4 class="timeline-slider-title">
                        {!!strip_tags($translations['tl_fourth'] ?? $translations_en['tl_fourth'])!!}</h4>
                </div>
            </div>
        </div>
        <div class="timeline-event" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="500">
            <div class="event-row timeline-row">
                <!-- Event Image -->
                <img src="/images/timeline/Final conference in Italy.jpg"
                    class="ag-timeline-card_img" alt="" />
                <!-- Event Content -->
                <div class="card-body">
                    <span class="timeline-slider-date"><i class="fas fa-calendar-alt"></i>
                        {!!strip_tags($translations['tl_date5'] ?? $translations_en['tl_date5'])!!}</span>
                    <h4 class="timeline-slider-title">
                        {!!strip_tags($translations['tl_fifth'] ?? $translations_en['tl_fifth'])!!}</h4>
                </div>
            </div>
        </div>
        <div class="timeline-event" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="500">
            <div class="event-row timeline-row">
                <!-- Event Image -->
                <img src="/images/timeline/Final conference in Spain.jpg"
                    class="ag-timeline-card_img" alt="" />
                <!-- Event Content -->
                <div class="card-body">
                    <span class="timeline-slider-date"><i class="fas fa-calendar-alt"></i>
                        {!!strip_tags($translations['tl_date6'] ?? $translations_en['tl_date6'])!!}</span>
                    <h4 class="timeline-slider-title">{!!strip_tags($translations['tl_sixth'] ?? $translations_en['tl_sixth'])!!}</h4>
                </div>
            </div>
        </div>
        <div class="timeline-event" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="500">
            <div class="event-row timeline-row">
                <img src="/images/timeline/Final conference in Bulgaria.png"
                    class="ag-timeline-card_img" alt="" />
                <div class="card-body">
                    <span class="timeline-slider-date"><i class="fas fa-calendar-alt"></i>
                        {!!strip_tags($translations['tl_date7'] ?? $translations_en['tl_date7'])!!}</span>
                    <h4 class="timeline-slider-title">{!!strip_tags($translations['tl_seventh'] ?? $translations_en['tl_seventh'])!!}</h4>
                </div>
            </div>
        </div>
        <div class="timeline-event" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="500">
            <div class="event-row timeline-row">
                <img src="/images/timeline/Final conference in Cyprus.png"
                    class="ag-timeline-card_img" alt="" />
                <div class="card-body">
                    <span class="timeline-slider-date"><i class="fas fa-calendar-alt"></i>
                        {!!strip_tags($translations['tl_date8'] ?? $translations_en['tl_date8'])!!}</span>
                    <h4 class="timeline-slider-title">{!!strip_tags($translations['tl_eighth'] ?? $translations_en['tl_eighth'])!!}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Roboto+Slab:wght@100..900&family=Yanone+Kaffeesatz:wght@200..700&display=swap');


    .container {
        gap: 50px;
        margin-top: 50px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        overflow-x: hidden;
    }

    .ag-timeline_title-box h4 {
        font-family: 'Outfit', sans-serif;
        font-size: 30px;
        color: #000;
        text-align: center;
        text-transform: uppercase;
    }



    .timeline-container {
        font-family: 'Yanone Kaffeesatz', sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        width: 1200px;
        margin-bottom: 50px;
    }

    .timeline-container::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #ccc;
    }

    .timeline-event {
        text-align: center;
        width: auto;
        height: auto;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .event-row.timeline-row img {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 400px;
        height: 250px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .timeline-event::before {
        content: '';
        position: absolute;
        left: 50%;
        height: 100%;
        border-left: 2px solid #ddd;
        z-index: 0;
    }

    .timeline-container.timeline-event-date {
        position: absolute;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        top: 0;
        background-color: #fff;
        padding: 0 5px;
        z-index: 2;
    }

    .event-row.timeline-row {
        height: 350px;
        width: 400px;
        background-color: #ECCD7A;
        border-radius: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-left: 20px;
        margin-right: 20px;
        text-decoration: none;
        color: black;
        box-shadow: #5C5FAD 0 0 10px;
    }

    .event-row.timeline-row .card-body {
        gap: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: auto;
    }

    .event-row.timeline-row::before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 30px;
        background-color: #5C5FAD;
        border-radius: 50%;
        z-index: 1;
    }

    .timeline-event:nth-child(odd) {
        padding-right: 50%;
    }

    .timeline-event:nth-child(even) {
        padding-left: 50%;
    }

    @media (prefers-reduced-motion: reduce) {
        .accordion-button {
            transition: none;
        }
    }
Z

    .card-body .timeline-slider-date {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        font-size: 20px;
        text-transform: uppercase;
    }

    /*Media Queries*/



    @media (max-width: 1200px) {

        .timeline-container {
            display: flex;
            flex-direction: column;
            width: 90%;
            gap: 50px;

        }

        .timeline-container::before {
            display: none;
        }


        .timeline-event::before {
            display: none;
        }

        .timeline-event:nth-child(odd) {
            justify-content: center;
            padding: 0;
        }

        .timeline-event:nth-child(even) {
            justify-content: center;
            padding: 0;
        }

        .event-row.timeline-row {
            width: auto;
            flex-direction: column;
        }

        .event-row.timeline-row::before {
            display: none;
        }
    }

    @media (max-width: 500px){
        .event-row.timeline-row img {
            width: 300px;
            height: 200px;
        }

        .event-row.timeline-row {
            width: 300px;
            height: 350px;
        }
    }
</style>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
