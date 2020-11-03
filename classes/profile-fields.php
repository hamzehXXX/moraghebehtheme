<?php
class ProfileFields {
    public $name;
    public $family;
    public $birth;
    public $phone;
    public $codemeli;
    public $marriage;
    public $children;
    public $gender;
    public $college_education;
    public $howzeh_education;
    public $khadem;
    public $country;
    public $province;
    public $city;
    public $address;
    public $email;
    public $phonehome;
    public $history_disease;
    public $userId;
    public $aqayed;
    public $aqayed_book;
    public $aqayed_progress;
    public $akhlaq;
    public $akhlaq_ketab;
    public $akhlaq_book;
    public $akhlaq_progress;
    public $marja_taqlid;
    public $ahkam;
    public $khoms;
    public $ravabet_khanevadegi;
    public $soluk_khanevadeh;
    public $hamrahi_khanevadeh;
    public $tasalot_zanashoyi;
    public $jalase_haftegi;
    public $ashnayii_ostad_month;
    public $ashnayii_ostad_year;
    public $nahveh_ashnayii;
    public $moaref_firstname;
    public $moaref_lastname;
    public $moaref_nesbat;
    public $paziresh_month;
    public $paziresh_year;
    public $daryaft_bateni;
    public $pooshesh;
    public $ezdiyad_nasl;
    public $tark_tv;
    public $adame_ezafekari;
    public $khab_shab;
    public $tahajod;
    public $ostad_qabli;
    public $ostad_qabli_name;
    public $shagerdi_duration;
    public $elat_jodayii;

    public $metaInput;

    /**
     * ProfileFields constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->name = sanitize_text_field($data['name']);
        $this->family = sanitize_text_field($data['family']);
        $this->birth = sanitize_text_field($data['birth']);
        $this->phone = sanitize_text_field($data['phone']);
        $this->codemeli = sanitize_text_field($data['codemeli']);
        $this->job = sanitize_text_field($data['job']);
        $this->marriage = sanitize_text_field($data['marriage']);
        $this->children = sanitize_text_field($data['children']);
        $this->gender = sanitize_text_field($data['gender']);
        $this->college_education = sanitize_text_field($data['college_education']);
        $this->howzeh_education = sanitize_text_field($data['howzeh_education']);
        $this->khadem = sanitize_text_field($data['khadem']);
        $this->country = sanitize_text_field($data['country']);
        $this->province = sanitize_text_field($data['province']);
        $this->city = sanitize_text_field($data['city']);
        $this->email = sanitize_text_field($data['email']);
        $this->address = sanitize_text_field($data['address']);
        $this->phonehome = sanitize_text_field($data['phonehome']);
        $this->history_disease = sanitize_text_field($data['history_disease ']);
        $this->userId = sanitize_text_field($data['userid']);
        $this->aqayed = sanitize_text_field($data['aqayed']);
        $this->aqayed_book = sanitize_text_field($data['aqayed_book']);
        $this->aqayed_progress = sanitize_text_field($data['aqayed_book']);
        $this->akhlaq = sanitize_text_field($data['akhlaq']);
        $this->akhlaq_ketab = sanitize_text_field($data['akhlaq_ketab']);
        $this->akhlaq_book = sanitize_text_field($data['akhlaq_book']);
        $this->marja_taqlid = sanitize_text_field($data['marja_taqlid']);
        $this->ahkam = sanitize_text_field($data['ahkam']);
        $this->khoms = sanitize_text_field($data['khoms']);
        $this->ravabet_khanevadegi = sanitize_text_field($data['ravabet_khanevadegi']);
        $this->soluk_khanevadeh = sanitize_text_field($data['soluk_khanevadeh']);
        $this->tasalot_zanashoyi = sanitize_text_field($data['tasalot_zanashoyi']);
        $this->hamrahi_khanevadeh = sanitize_text_field($data['hamrahi_khanevadeh']);
        $this->jalase_haftegi = sanitize_text_field($data['jalase_haftegi']);
        $this->ashnayii_ostad_month = sanitize_text_field($data['ashnayii_ostad_month']);
        $this->ashnayii_ostad_year = sanitize_text_field($data['ashnayii_ostad_year']);
        $this->nahveh_ashnayii = sanitize_text_field($data['ashnayii_ostad_year']);
        $this->moaref_firstname = sanitize_text_field($data['moaref_firstname']);
        $this->moaref_lastname = sanitize_text_field($data['moaref_lastname']);
        $this->moaref_nesbat = sanitize_text_field($data['moaref_nesbat']);
        $this->paziresh_month = sanitize_text_field($data['paziresh_month']);
        $this->paziresh_year = sanitize_text_field($data['paziresh_year']);
        $this->daryaft_bateni = sanitize_text_field($data['daryaft_bateni']);
        $this->pooshesh = sanitize_text_field($data['pooshesh']);
        $this->ezdiyad_nasl = sanitize_text_field($data['ezdiyad_nasl']);
        $this->tark_tv = sanitize_text_field($data['tark_tv']);
        $this->adame_ezafekari = sanitize_text_field($data['adame_ezafekari']);
        $this->khab_shab = sanitize_text_field($data['khab_shab']);
        $this->tahajod = sanitize_text_field($data['tahajod']);
        $this->ostad_qabli = sanitize_text_field($data['ostad_qabli']);
        $this->ostad_qabli_name = sanitize_text_field($data['ostad_qabli_name']);
        $this->shagerdi_duration = sanitize_text_field($data['shagerdi_duration']);
        $this->elat_jodayii = sanitize_text_field($data['elat_jodayii']);


        $this->metaInput = array(
            'name' => $this->name,
            'family' => $this->family,
            'birth' => $this->birth,
            'phone' => $this->phone,
            'codemeli' => $this->codemeli,
            'college_education' => $this->college_education,
            'howzeh_education' => $this->howzeh_education,
            'marriage' => $this->marriage,
            'children' => $this->children,
            'gender' => $this->gender,
            'khadem' => $this->khadem,
            'country' => $this->country,
            'province' => $this->province,
            'city' => $this->city,
            'email' => $this->email,
            'address' => $this->address,
            'phonehome' => $this->phonehome,
            'history_disease' => $this->history_disease,
            'user_id' => $this->userId,
            'aqayed' => $this->aqayed,
            'aqayed_book' => $this->aqayed_book,
            'aqayed_progress' => $this->aqayed_progress,
            'akhlaq' => $this->akhlaq,
            'akhlaq_ketab' => $this->akhlaq_ketab,
            'akhlaq_book' => $this->akhlaq_book,
            'akhlaq_progress' => $this->akhlaq_progress,
            'marja_taqlid' => $this->marja_taqlid,
            'ahkam' => $this->ahkam,
            'khoms' => $this->khoms,
            'ravabet_khanevadegi' => $this->ravabet_khanevadegi,
            'soluk_khanevadeh' => $this->soluk_khanevadeh,
            'tasalot_zanashoyi' => $this->tasalot_zanashoyi,
            'hamrahi_khanevadeh' => $this->hamrahi_khanevadeh,
            'jalase_haftegi' => $this->jalase_haftegi,
            'ashnayii_ostad_month' => $this->ashnayii_ostad_month,
            'ashnayii_ostad_year' => $this->ashnayii_ostad_year,
            'nahveh_ashnayii' => $this->nahveh_ashnayii,
            'moaref_firstname' => $this->moaref_firstname,
            'moaref_lastname' => $this->moaref_lastname,
            'moaref_nesbat' => $this->moaref_nesbat,
            'paziresh_month' => $this->paziresh_month,
            'paziresh_year' => $this->paziresh_year,
            'daryaft_bateni' => $this->daryaft_bateni,
            'pooshesh' => $this->pooshesh,
            'ezdiyad_nasl' => $this->ezdiyad_nasl,
            'tark_tv' => $this->tark_tv,
            'adame_ezafekari' => $this->adame_ezafekari,
            'khab_shab' => $this->khab_shab,
            'tahajod' => $this->tahajod,
            'ostad_qabli' => $this->ostad_qabli,
            'ostad_qabli_name' => $this->ostad_qabli_name,
            'shagerdi_duration' => $this->shagerdi_duration,
            'elat_jodayii' => $this->elat_jodayii
        );
    }

    /**
     * @return array
     */
    public function getMetaInput()
    {
        return $this->metaInput;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFamily()
    {
        return $this->family;
    }

}
