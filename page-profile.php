<?php get_header();
while(have_posts()) {
    the_post(); ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php the_title(); ?></h1>
            <div class="page-banner__intro">

            </div>
        </div>
    </div>



    <div class="generic-content">
        <?php
        // check if profile for current user exists
        $existStatus = 'no';

        if (is_user_logged_in()) {
            $existQuery = new WP_Query(array(
                'post_type' => 'profile',
                'meta_query' => array(
                    array(
                        'key' => 'user_id',
                        'compare' => '=',
                        'value' => get_current_user_id()
                    )
                )
            ));

            if ($existQuery->found_posts) {
                $existStatus = 'yes';

                while ($existQuery->have_posts()) {
                    $existQuery->the_post();

            }
        }
        }
        ?>
        <form aria-disabled="true">

            <ul class="form-style-1" data-exists="<?php if (is_user_logged_in()) echo $existStatus; ?>" data-id="<?php if (is_user_logged_in()) echo $existQuery->posts[0]->ID; ?>" data-userid="<?php if (is_user_logged_in()) echo get_current_user_id(); ?>">
                <span class="required">* وارد کردن فیلد های ستاره دار ضروری می باشد.</span>
                <hr/>
                <li>
                    <span class="edit-profile"><i class="fa fa-pencil" aria-hidden="true"></i> ویرایش</span>
                    <span class="save-profile">ذخیره <i class="fa fa-arrow-left" aria-hidden="true"></i></span>
                </li>
                <br/>
                <hr/>
                <li><label>نام و نام خانوادگی <span class="required">*</span></label>
                    <input readonly type="text" name="name" id="name" class="field-divided " placeholder="نام" value="<?php if (is_user_logged_in()) esc_attr(the_field('name')); ?>" />
                    <input readonly type="text" name="family" id="family" class="field-divided " placeholder="نام خانوادگی" value="<?php if (is_user_logged_in()) esc_attr(the_field('family')); ?>" />
                </li>
                <li><label>سال تولد<span class="required">*</span></label>
                    <input readonly type="text" name="birth" id="birth" class="field-divided " placeholder="مثال: 1350" value="<?php the_field('birth'); ?>" />
                </li>
                <li><label>شماره تماس <span class="required">*</span></label>
                    <input readonly type="text" name="phone" id="phone" class="field-divided " placeholder="09XX-XXX-XXXX" value="<?php if (is_user_logged_in()) esc_attr(the_field('phone')); ?>" />
                </li>
                <li>
                    <label>کد ملی <span class="required">*</span></label>
                    <input readonly type="text" name="codemeli" id="codemeli" class="field-divided " placeholder="کد ملی" value="<?php if (is_user_logged_in()) esc_attr(the_field('codemeli')); ?>" />

                </li>
                <li>
                    <?php
                    if (is_user_logged_in()){
                        $edu_cert = get_field('college_education');
                         }
                    ?>
                    <label>تحصیلات دانشگاهی</label>
                    <select disabled name="college_education" class="field-select" id="college_education">
                        <option value="None" <?php if (is_user_logged_in()) if($edu_cert == 'ندارم') {echo "selected";}?> >ندارم</option>
                        <option value="AssociateDegree" <?php if (is_user_logged_in()) if($edu_cert == 'فوق دیپلم') {echo "selected";}?> >فوق دیپلم</option>
                        <option value="Bachelor" <?php if (is_user_logged_in()) if($edu_cert == 'کارشناسی (لیسانس)') {echo "selected";}?> >کارشناسی (لیسانس)</option>
                        <option value="Master" <?php if (is_user_logged_in()) if($edu_cert == 'کارشناسی ارشد (فوق لیسانس)') {echo "selected";}?> >کارشناسی ارشد (فوق لیسانس)</option>
                    </select>
                </li>
                <li>
                    <?php
                    if (is_user_logged_in()){
                        $hozeh_cert = get_field('howzeh_education');
                    }
                    ?>
                    <label>تحصیلات حوزوی</label>
                    <select disabled name="howzeh_education" class="field-select" id="howzeh_education">
                        <option value="None" <?php if (is_user_logged_in()) if($edu_cert == 'ندارم') {echo "selected";}?> >ندارم</option>
                        <option value="Primary" <?php if (is_user_logged_in()) if($edu_cert == 'مقدمات') {echo "selected";}?> >مقدمات</option>
                        <option value="Level1" <?php if (is_user_logged_in()) if($edu_cert == 'سطح 1') {echo "selected";}?> >سطح 1</option>
                        <option value="Level2" <?php if (is_user_logged_in()) if($edu_cert == 'سطح 2') {echo "selected";}?> >سطح 2</option>
                        <option value="Level3" <?php if (is_user_logged_in()) if($edu_cert == 'سطح 3') {echo "selected";}?> >سطح 3</option>
                        <option value="Kharej" <?php if (is_user_logged_in()) if($edu_cert == 'درس خارج') {echo "selected";}?> >درس خارج</option>
                    </select>
                </li>
                <li>
                    <label>شغل <span class="required">*</span></label>
                    <input readonly type="text" name="job" id="job" class="field-divided " placeholder="شغل" value="<?php if (is_user_logged_in()) esc_attr(the_field('job')); ?>" />

                </li>
                <li>
                    <?php
                    if (is_user_logged_in()){
                        $marriage = get_field('marriage');
                        $gender = get_field('gender'); }
                    ?>
                    <label>وضعیت تاهل</label>
                    <select disabled name="marriage" class="field-select" id="marriage">
                        <option value="Advertise" <?php if (is_user_logged_in()) if($marriage == 'متاهل') {echo "selected";}?> >متاهل</option>
                        <option value="Partnership" <?php if (is_user_logged_in()) if($marriage == 'مجرد') {echo "selected";}?> >مجرد</option>
                        <option value="Partnership" <?php if (is_user_logged_in()) if($marriage == 'فوت همسر') {echo "selected";}?> >فوت همسر</option>
                        <option value="Partnership" <?php if (is_user_logged_in()) if($marriage == 'جدا شده') {echo "selected";}?> >جدا شده</option>
                    </select>
                </li>

                <li>
                    <label>تعداد فرزندان <span class="required">*</span></label>
                    <input readonly type="number" min="0" max="12" name="children" class="field-divided" id="children" placeholder="تعداد فرزندان" value="<?php if (is_user_logged_in()) esc_attr(the_field('children')); ?>" />
                </li>
                <li>
                    <label>کشور <span class="required">*</span></label>
                    <input readonly type="text" name="country" class="field-divided" id="country" placeholder="کشور" value="<?php if (is_user_logged_in()) esc_attr(the_field('country')); ?>" />
                </li>
                <li>
                    <label>جنسیت</label>
                    <select disabled name="gender" class="field-select" id="gender">
                        <option value="Advertise" <?php if (is_user_logged_in()) if ($gender == 'مرد') echo "selected";?> >مرد</option>
                        <option value="Partnership" <?php if (is_user_logged_in()) if ($gender == 'زن') echo "selected";?> >زن</option>
                    </select>
                </li>

                <li>
                    <label>نام خادم <span class="required">*</span></label>
                    <input readonly type="text" name="khadem" class="field-divided" id="khadem" placeholder="نام خادم" value="<?php if (is_user_logged_in()) esc_attr(the_field('khadem')); ?>" />
                </li>
                <li>
                    <label>محل سکونت<span class="required">*</span></label>
                    <input readonly type="text" name="country" class="field-divided" id="country" placeholder="کشور" value="<?php if (is_user_logged_in()) esc_attr(the_field('country')); ?>" />
                    <input readonly type="text" name="province" class="field-divided" id="province" placeholder="استان" value="<?php if (is_user_logged_in()) esc_attr(the_field('province')); ?>" />
                    <input readonly type="text" name="city" class="field-divided" id="city" placeholder="شهر" value="<?php if (is_user_logged_in()) esc_attr(the_field('city')); ?>" />
                </li>

                <li>
                    <label>پست الکترونیکی </label>
                    <input readonly type="email" name="email" id="email" class="field-long" value="<?php if (is_user_logged_in()) esc_attr(the_field('email')); ?>" />
                </li>

                <li>
                    <label>آدرس <span class="required">*</span></label>
                    <textarea readonly name="address" id="address" class="field-long field-textarea" rows="4" cols="10" ><?php if (is_user_logged_in()) esc_attr(the_field('address')); ?></textarea>
                </li>
                <li>
                    <label>شماره تلفن سکونت<span class="required">*</span></label>
                    <input readonly type="text" name="phonehome" id="phonehome" class="field-divided " placeholder="021xxxxxxxx" value="<?php if (is_user_logged_in()) esc_attr(the_field('phonehome')); ?>" />
                </li>

                <li>
                    <label>سابقه بیماری خاص <span class="required">*</span></label>
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">دارم</label>
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">ندارم</label><br>

                    <p>درصورتی که سابه</p>
                    <textarea readonly name="address" id="address" class="field-long field-textarea" rows="4" cols="10" ><?php if (is_user_logged_in()) esc_attr(the_field('address')); ?></textarea>

                </li>

                <li>
                    <span class="edit-profile"><i class="fa fa-pencil" aria-hidden="true"></i> ویرایش</span>
                    <span class="save-profile">ذخیره <i class="fa fa-arrow-left" aria-hidden="true"></i></span>
                </li>
            </ul>
        </form>



    </div>

<?php }
get_footer();
?>