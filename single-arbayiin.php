<?php get_header();
include_once('jdf.php');
while(have_posts()) {
    the_post();


    $duration = get_field('arbayiin-duration');
    $ruz = "روز";
    $nthday = [
        "اول", "دوم", "سوم", "چهارم", "پنجم", "ششم", "هفتم", "هشتم", "نهم", "دهم",
        "یازدهم", "دوازدهم", "سیزدهم", "چهاردهم", "سیزدهم", "چهاردهم", "پانزدهم", "شانزدهم",
        "هفدهم", "هجدهم", "نوزدهم", "بیستم", "بیست و یکم", "بیست و دوم", "بیست و سوم", "بیست و چهارم",
        "بیست و پنجم", "بیست و ششم", "بیست و هفتم", "بیست و هشتم", "بیست و نهم", "سیم", "سی و یکم",
        "سی و دوم", "سی و سوم", "سی و چهارم", "سی و پنجم", "سی و ششم", "سی و هفتم", "سی و هشتم",
        "سی و نهم", "چهلم"
    ];
    // GET AMALS WHERE CURRENT USER ID HAVE POSTED FOR CURRENT ARBAYIIN ================================================================================================
    $amalResults = new WP_Query(array(
        'post_type' => 'amal',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'author' => get_current_user_id(),
        'meta_key' => 'arbayiin',
        'meta_query' => array(
            'key' => 'arbayiin',
            'compare' => '=',
            'value' => get_the_ID()
        )));
    $amalSize = $amalResults -> found_posts;
//    echo 'boodoogoo'.$amalSize. " ". get_current_user_id();
    $today = jdate('Y-m-d');

    $amalDay = $today;
    $startAmal = $today;
    $days = [];
    if ($amalSize) {
        $startAmal = get_the_date('Y-m-d', $amalResults -> posts[0] -> ID); // get the date of the first submitted amal results
        $amalDay = get_the_date('Y-m-d', $amalResults -> posts[$amalSize - 1] -> ID); // Get the date of the last submited amal results

        $period = new DatePeriod(
            new DateTime($startAmal), // Start date of the period
            new DateInterval('P1D'), // Define the intervals as Periods of 1 Day
            $duration // Apply the interval $duration times on top of the starting date
        );
        foreach ($period as $day) {
            $days[] = $day -> format('Y-m-d');
        }
        $currentDayTimeStamp = strtotime($days[$amalSize]);
        $currentDayDate = jdate('l, m/d', $currentDayTimeStamp);
    }

//********************************       [ PAGE BANNER ]       ********************************* START >>>>>>
    ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php the_title(); ?></h1>
            <div class="page-banner__intro">

            </div>
        </div>
    </div>
<?php ####################################################################################### END <<<<<<<<<<<<<<<<<<?>
    <!--    //======================================================================-->
    <!--    // CONTAINER - PAGE SECTION -->
    <!--    //======================================================================-->

    <div class="container container--narrow page-section">
<!--        //------------------------------------------------------->
<!--        // Meta-Box-->
<!--        //------------------------------------------------------->

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('arbayiin'); ?>"><i class="fa fa-home" aria-hidden="true"></i> اربعینیات </a> <span>مدت اربعین:</span><span class="metabox__main"><?php  echo $duration; ?></span></p>
        </div>

        <!--        //------------------------------------------------------->
        <!--        // contents-->
        <!--        //------------------------------------------------------->

        <div class="generic-content">
        <div style="margin-right: 15px"><?php the_content(); ?></div>

<!--            /* If amalsize is less than arbayiin duration show the inputs for arbayiins */-->
    <?php if( $amalSize < $duration ): ?>
            <?php if( have_rows('amal') ): ?>

            <!--    Header Table -->

                <div class='some-page-wrapper'>
<!--                    First Row   -->
                    <div class='row table-header'>
                        <div class='orange-column ' >
                        ردیف
                        </div>
                        <div class='blue-column'>
                            نام عمل
                        </div>

                        <div class='green-column ruz' style="width:200px; " data-arbayiin-id="<?php echo get_the_ID(); ?>"
                             data-author = "<?php echo get_current_user_id() ?>" data-farda="<?php echo $ruz . ' ' . $nthday[$amalSize];?>" data-daycount = "<?php echo $amalSize; ?>">
                            <?php echo $ruz . ' ' . $nthday[$amalSize];  // echo out the day
                            if ($amalSize){ // if there is a saved amal
                                echo '(' . $currentDayDate . ')';
                            } else {
                                echo '(' . jdate('l, m/d') . ')';
                            }

                            ?>
                        </div>
                    </div>


                    <?php
                    $taskCount = 1;
                    $dayPointsArray = [];
                    while (have_rows('amal')): the_row();
                        // vars
                        $name = get_sub_field('amal_name');
                        $content = get_sub_field('amal_desc');
                        $repeat = get_sub_field('amal_repeat');
                        $weekDay = get_sub_field('weekday');
                        ?>
                        <!--                    Amal Rows   -->
                        <div class='row' data-content="<?php echo $content; ?>" data-name="<?php echo $name; ?>">

                            <div class='orange-column'>
                                <?php echo $taskCount; $taskCount++ ?>
                            </div>

                            <div class='blue-column amal-js'>
                                <?php $amalName = $name  ;
                                if ($repeat == 'روزانه'){
                                    echo $amalName;
                                } else {
                                    $specificDay = get_sub_field('specific_day');
                                    if ($specificDay) {
                                        echo $name . ' (' . $weekDay . ' ها'. ')';
                                    } else { echo $name;}
                                }
                                ?>
                            </div>



                                    <div class='green-column ' style="width:200px;">
                                        <?php
                                        if (!($repeat == "هفتگی")) {
                                            $disabledSelect = 'enable';
                                            if ($amalSize){
                                                if (($today < jdate('Y-m-d',strtotime($days[($amalSize - 1)]))) OR $amalSize==0){
                                                    $disabledSelect = 'disabled';
                                                }
                                            }

                                        ?>
                                        <select class="select-css" <?php echo $disabledSelect; ?>>
                                            <option>0 (انجام ندادم)</option>
                                            <option>1 (ضعیف)</option>
                                            <option>2 (متوسط)</option>
                                            <option>3 (قوی)</option>
                                        </select>
                                           <?php
                                } else {
                                            $specificDay = get_sub_field('specific_day');
                                            if ($specificDay) {
                                                if ($amalSize) {
                                                    if ($weekDay == jdate('l', $currentDayTimeStamp)) {
                                                        ?>
                                                        <select class="select-css">
                                                            <option>0 (انجام ندادم)</option>
                                                            <option>1 (ضعیف)</option>
                                                            <option>2 (متوسط)</option>
                                                            <option>3 (قوی)</option>
                                                        </select>
                                                        <?php
                                                    } else { ?>
                                                        <select class="select-css select-css__inactive" disabled>
                                                            <option>0<?php echo ' مخصوص ' . $weekDay ?></option>

                                                        </select>
                                                        <?php echo ' مخصوص ' . $weekDay ?>
                                                    <?php }
                                                } else {
                                                    if ($weekDay == jdate('l')){
                                                        ?>
                                                        <select class="select-css">
                                                            <option>0 (انجام ندادم)</option>
                                                            <option>1 (ضعیف)</option>
                                                            <option>2 (متوسط)</option>
                                                            <option>3 (قوی)</option>
                                                        </select>
                                                        <?php
                                                    } else { ?>
                                                        <select class="select-css select-css__inactive" disabled>
                                                            <option>0<?php echo ' مخصوص ' . $weekDay ?></option>

                                                        </select>
                                                        <?php echo ' مخصوص ' . $weekDay ?>
                                                    <?php }
                                                }
                                            } else {
                                                ?>
                                                <select class="select-css">
                                                    <option>0 (انجام ندادم)</option>
                                                    <option>1 (ضعیف)</option>
                                                    <option>2 (متوسط)</option>
                                                    <option>3 (قوی)</option>
                                                    <option>3 (انجام دادم)</option>
                                                </select>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>


                        </div>
                        <div style="display: none;" class="pop-outer">
                            <div class="pop-inner">
                                <button class="close-popup">X</button>
                                <hr/>
                                <h5></h5>
                                <p></p>

                            </div>
                        </div>
                    <?php endwhile; ?>
                    <div class='row'>
                        <div class='orange-column' >

                        </div>

                        <div class='blue-column'>

                        </div>
                        <?php if ($amalSize){ ?>
                <?php if (($today > jdate('Y-m-d',strtotime($days[($amalSize - 1)]))) OR $amalSize==0){ ?>
                        <div class='green-column ' style="width:200px;">
                            <span class="sabtamal" id="sabt-amal">ثبت اعمال امروز  <i class="fa fa-arrow-left" aria-hidden="true"></i></span> </div>
                        <?php } else{ ?>
                <div><span  >اعمال روز <?php echo jdate('l, d-m-Y',strtotime($days[$amalSize-1])) . '<br>'  ?> با موفقیت ثبت شد </span> </div>
                <?php }
                } else {
                            ?>
                    <div class='green-column ' style="width:200px;">
                        <span class="sabtamal" id="sabt-amal">ثبت اعمال امروز  <i class="fa fa-arrow-left" aria-hidden="true"></i></span> </div>
                <?php
                }
                ?>
                    </div>

                </div>

                <hr class="section-break"/>

            <?php endif; ?>
    <?php endif; ?>

            <?php

        //======================================================================
        // ARBAYIIN RESULTS FORM
        //======================================================================

        $resultsForm = new WP_Query(array(
              'post_type' => 'resultform',
              'posts_per_page' => -1,
                'author' => get_current_user_id(),
                 'meta_key' => 'arbayiinid',
                 'meta_query' => array(
                    'key' => 'arbayiinid',
                'compare' => '=',
                'value' =>  get_the_ID()
            )
            ));
 ?>

        <?php if (($amalSize >= $duration) AND (!($resultsForm->found_posts))): ?>

     <div class="results-form">
            <h5 class="results-form__header" >فرم نتایج اربعینیات</h5>
            <div class="results-form__forms">
            <h6 >حالات شما در طی این اربعین</h6>
            <textarea class="new-note-body field-long field-textarea results-form__textarea" id="halat" placeholder="به طور کلی شرایط روحی خود در طی این اربعین را ذکر بفرمایید. لزوما نباید شامل موارد خارق العاده ای باشد لذا حالات خود را به تفصیل و مشروح بیان نمایید."></textarea>
            </div>
         <div class="results-form__forms">
            <h6 >وضعیت شما در طی این اربعین از حیث «خوف و رجا» و «قبض و بسط»</h6>

            <textarea class="new-note-body field-long field-textarea results-form__textarea" id="vaziyat" placeholder=""></textarea>
            </div>
         <div class="results-form__forms">
            <h6 >خواب ها و رویاهای صادقه (در صورت رخ دادن)</h6>

            <textarea class="new-note-body field-long field-textarea results-form__textarea" id="khab" placeholder=""></textarea>
            </div>
            <span class="results-form__submit" data-arbayiinid="<?php echo get_the_ID(); ?>">ثبت نتایج</span>
        </div>
        <?php endif; ?>

</div>
    <hr class="section-break">

<?php
        //======================================================================
        // ARBAYIIN RESULTS TABLE
        //======================================================================
/*
 * In a ul List which ul display is set to table
 * and .arbayiin-table's overflow-x: auto;
 *
*/
?>
        <div class="arbayiin-results-title">نتایج اربعین</div>

            <div class="arbayiin-table">
            <ul class="min-list" id="results">
<?php
                //-----------------------------------------------------
                // First Column of the Table -- NUMBERS
                //-----------------------------------------------------
?>
                <li class=" dd" >
                        <div class="t-header" >ردیف</div>

                        <?php
                        $taskCount = 1;
                        while (have_rows('amal')): the_row();
                            // vars
                            $name = get_sub_field('amal_name');
                            $content = get_sub_field('amal_desc');
                            $repeat = get_sub_field('amal_repeat');
                            $weekDay = get_sub_field('weekday');
                            ?>
                    <div class="table-num "><?php echo $taskCount; $taskCount++ ?></div>
                        <?php endwhile; ?>
                        <div class="table-num" style="color:  #fffFFF; background-color: #fffFFF"  >-</div>
                        <div class="table-num" style="color:  #fffFFF; background-color: #fffFFF" >-</div>
                    </li>

                <?php
                //-----------------------------------------------------
                // Second Column of the Table -- NAMES
                //-----------------------------------------------------
                ?>

                <li class="ddd  " style="display: table-cell; " >
                    <div class="nameheader" >نام عمل</div>

                    <?php
                    $taskCount = 1;
                    while (have_rows('amal')): the_row();
                        // vars
                        $name = get_sub_field('amal_name');
                        $content = get_sub_field('amal_desc');
                        $repeat = get_sub_field('amal_repeat');
                        $weekDay = get_sub_field('weekday');
                        $taskCount++;
                        ?>
                        <div class="resultname" ><?php echo $name;  ?></div>
                    <?php endwhile; ?>
                    <div class="resultname" style="background-color:#7ad2ee; color: #FFFFFF"  >جمع امتیازات روز</div>

                    <!-- NAME COLUMN: DATE CELL -->

                    <div class="resultname sabtdate"  style="background-color: #cbcbcb" >تاریخ ثبت</div>

                </li>


                <?php
                //-----------------------------------------------------
                // RESULT Columns of the Table
                //-----------------------------------------------------
                ?>
                <?php

                while ($amalResults-> have_posts()) {  // loop through results posts
                $amalResults -> the_post();
                ?>
                <li class="row" style="display: table-cell; " >

                  <?php #header ?>
                            <div class="t-header" ><?php echo get_field('day') ?></div>

                            <?php
                            $results = get_field('results'); // Get results field which is a string seperating each result by a ','
                            $array = explode(',', $results);  // explode result's String into an Array
                            $sumDayPoints = 0;  // Initialize the sum of the day's result points

                            foreach($array as $item): // Loop through result's array

                                preg_match_all('!\d+!', $item, $matches); // we get only numbers in each result from the array and store them into an array called $matches
//                            array_push($dayPointsArray, intval(implode(' ', $matches[0]))); // get numbers from matches and convert their type to integer and push in $sumDayPoints
                                $sumDayPoints += intval(implode(' ', $matches[0]));
                        ?>
                        <!-- DAY COLUMNS RESULT VALUES -->
                        <div class="resultvalue" ><?php echo $item; ?></div>
                      <?php endforeach; ?>

                    <?php

                    // COLOR GRADING FOR THE WHOLE DAY POINTS
                        if ($sumDayPoints >= ($taskCount*3)*0.6)$sumPointsColor = '#d6ffe7';
                        if ($sumDayPoints >= ($taskCount*3)*0.3 AND $sumDayPoints <($taskCount*3)*0.6)$sumPointsColor = '#fff9d1';
                    if ($sumDayPoints < ($taskCount*3)*0.3)$sumPointsColor = '#ffdbdb';
                    ?>

                    <!-- DAY COLUMNS SUM POINTS -->
                    <div class="resultvalue" style=" border:0; background-color: <?php echo $sumPointsColor ?>"><?php echo $sumDayPoints; ?></div>

                    <!-- DAY COLUMNS DATE OF SUBMIT -->
                    <div class="resultvalue" style="background-color: #ECECEC; direction: ltr"><?php echo jdate('Y-m-d',strtotime(get_the_date())); ?></div>

                </li>
                <?php }  wp_reset_postdata();  ?>
            </ul>
            </div>
                <hr class="section-break"/>

        <?php


        //********************************       [ RESULTS FORM ]       ********************************* START >>>>>>


    while ($resultsForm -> have_posts()) {
        $resultsForm -> the_post();
        ?>
        <div>
        <h5>حالات شما در طی این اربعین</h5><p><?php esc_attr(the_field('halat')) ?></p>
        <h5>وضعیت شما در طی این اربعین از حیث «خوف و رجا» و «قبض و بسط»</h5><p><?php esc_attr(the_field('vaziyat')) ?></p>
        <h5>خواب ها و رویاهای صادقه (در صورت رخ دادن)</h5><p><?php esc_attr(the_field('khab')) ?></p>
        </div>
        <?php
}
       //####################################################################################### END <<<<<<<<<<<<<<<<<<
 ?>

                <hr class="section-break"/>


        <?php
        //======================================================================
        // RELATED POSTS
        //======================================================================
        $homepagePosts = new WP_Query(array(
            'posts_per_page' => -1,
            'meta_key' => 'related_arbayiin',
            'meta_query' => array(
                    'key' => 'related_arbayiin',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
            )
        ));
        if ($homepagePosts->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline--medium headline">اطلاعیه های ' . get_the_title() . '</h2>';

            while ($homepagePosts->have_posts()) {
                $homepagePosts->the_post();
                ?>
                <div class="event-summary">
                    <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                        <span class="event-summary__month"><?php the_time('M'); ?></span>
                        <span class="event-summary__day"><?php the_time('d'); ?></span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p><?php if (has_excerpt()) {
                                echo get_the_excerpt();
                            } else {
                                echo wp_trim_words(get_the_content(), 18);
                            } ?><a href="<?php the_permalink(); ?>" class="nu gray">بیشتر بخوانید</a></p>
                    </div>
                </div>
            <?php } wp_reset_postdata();
        }
        ?>
    </div>

<?php } wp_reset_postdata();
get_footer();
?>