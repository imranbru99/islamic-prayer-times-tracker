<?php

namespace App\Http\Controllers;

class PrayerController extends Controller
{
    public function times()
    {
        $pageTitle = 'Prayer Times';
        return view(activeTemplate() . 'prayer.times', compact('pageTitle'));
    }

    public function qibla()
    {
        $pageTitle = 'Qibla Direction';
        return view(activeTemplate() . 'prayer.qibla', compact('pageTitle'));
    }

    public function tasbih()
    {
        $pageTitle = 'Digital Tasbih';
        $phrases = [
            ['ar' => 'سُبْحَانَ اللّٰهِ', 'en' => 'SubhanAllah', 'meaning' => 'Glory be to Allah'],
            ['ar' => 'الْحَمْدُ لِلّٰهِ', 'en' => 'Alhamdulillah', 'meaning' => 'All praise is for Allah'],
            ['ar' => 'اللّٰهُ أَكْبَرُ', 'en' => 'Allahu Akbar', 'meaning' => 'Allah is the Greatest'],
            ['ar' => 'لَا إِلٰهَ إِلَّا اللّٰهُ', 'en' => 'La ilaha illallah', 'meaning' => 'There is no god but Allah'],
            ['ar' => 'أَسْتَغْفِرُ اللّٰهَ', 'en' => 'Astaghfirullah', 'meaning' => 'I seek forgiveness from Allah'],
            ['ar' => 'سُبْحَانَ اللّٰهِ وَبِحَمْدِهِ', 'en' => 'SubhanAllahi wa bihamdihi', 'meaning' => 'Glory and praise be to Allah'],
            ['ar' => 'لَا حَوْلَ وَلَا قُوَّةَ إِلَّا بِاللّٰهِ', 'en' => 'La hawla wa la quwwata illa billah', 'meaning' => 'There is no power except with Allah'],
            ['ar' => 'اللَّهُمَّ صَلِّ عَلَىٰ مُحَمَّدٍ', 'en' => 'Allahumma salli ala Muhammad', 'meaning' => 'O Allah, send blessings upon Muhammad'],
        ];
        return view(activeTemplate() . 'prayer.tasbih', compact('pageTitle', 'phrases'));
    }

    public function duas()
    {
        $pageTitle = 'Daily Duas';
        $duas = [
            ['category' => 'Morning', 'title' => 'Morning Remembrance', 'ar' => 'أَصْبَحْنَا وَأَصْبَحَ الْمُلْكُ لِلَّهِ', 'en' => 'We have entered the morning and the dominion belongs to Allah.', 'ref' => 'Muslim'],
            ['category' => 'Evening', 'title' => 'Evening Remembrance', 'ar' => 'أَمْسَيْنَا وَأَمْسَى الْمُلْكُ لِلَّهِ', 'en' => 'We have entered the evening and the dominion belongs to Allah.', 'ref' => 'Muslim'],
            ['category' => 'Travel', 'title' => 'Travel Dua', 'ar' => 'سُبْحَانَ الَّذِي سَخَّرَ لَنَا هَٰذَا وَمَا كُنَّا لَهُ مُقْرِنِينَ', 'en' => 'Glory to Him who has subjected this to us, and we could not have done it by ourselves.', 'ref' => 'Quran 43:13'],
            ['category' => 'Food', 'title' => 'Before Eating', 'ar' => 'بِسْمِ اللَّهِ', 'en' => 'In the name of Allah.', 'ref' => 'Abu Dawud'],
            ['category' => 'Food', 'title' => 'After Eating', 'ar' => 'الْحَمْدُ لِلَّهِ الَّذِي أَطْعَمَنَا وَسَقَانَا وَجَعَلَنَا مُسْلِمِينَ', 'en' => 'Praise be to Allah who fed us, gave us drink, and made us Muslims.', 'ref' => 'Abu Dawud'],
            ['category' => 'Sleep', 'title' => 'Before Sleep', 'ar' => 'بِاسْمِكَ اللَّهُمَّ أَمُوتُ وَأَحْيَا', 'en' => 'In Your name, O Allah, I die and I live.', 'ref' => 'Bukhari'],
            ['category' => 'Home', 'title' => 'Entering the Home', 'ar' => 'بِسْمِ اللَّهِ وَلَجْنَا، وَبِسْمِ اللَّهِ خَرَجْنَا', 'en' => 'In the name of Allah we enter, and in the name of Allah we leave.', 'ref' => 'Abu Dawud'],
            ['category' => 'Protection', 'title' => 'Seeking Protection', 'ar' => 'أَعُوذُ بِكَلِمَاتِ اللَّهِ التَّامَّاتِ مِنْ شَرِّ مَا خَلَقَ', 'en' => 'I seek refuge in the perfect words of Allah from the evil of what He has created.', 'ref' => 'Muslim'],
            ['category' => 'Forgiveness', 'title' => 'Sayyid al-Istighfar', 'ar' => 'اللَّهُمَّ أَنْتَ رَبِّي لَا إِلَٰهَ إِلَّا أَنْتَ، خَلَقْتَنِي وَأَنَا عَبْدُكَ', 'en' => 'O Allah, You are my Lord, there is no god but You. You created me and I am Your servant.', 'ref' => 'Bukhari'],
            ['category' => 'Guidance', 'title' => 'Istikhara Opening', 'ar' => 'اللَّهُمَّ إِنِّي أَسْتَخِيرُكَ بِعِلْمِكَ وَأَسْتَقْدِرُكَ بِقُدْرَتِكَ', 'en' => 'O Allah, I seek Your guidance by Your knowledge and I seek ability by Your power.', 'ref' => 'Bukhari'],
            ['category' => 'Anxiety', 'title' => 'Relief from Worry', 'ar' => 'اللَّهُمَّ إِنِّي أَعُوذُ بِكَ مِنَ الْهَمِّ وَالْحَزَنِ', 'en' => 'O Allah, I seek refuge in You from worry and grief.', 'ref' => 'Bukhari'],
            ['category' => 'Parents', 'title' => 'Dua for Parents', 'ar' => 'رَبِّ ارْحَمْهُمَا كَمَا رَبَّيَانِي صَغِيرًا', 'en' => 'My Lord, have mercy upon them as they brought me up when I was small.', 'ref' => 'Quran 17:24'],
        ];
        return view(activeTemplate() . 'prayer.duas', compact('pageTitle', 'duas'));
    }

    public function names()
    {
        $pageTitle = '99 Names of Allah';
        $names = [
            ['ar' => 'الرَّحْمَٰنُ', 'en' => 'Ar-Rahman', 'meaning' => 'The Most Merciful'],
            ['ar' => 'الرَّحِيمُ', 'en' => 'Ar-Raheem', 'meaning' => 'The Especially Merciful'],
            ['ar' => 'الْمَلِكُ', 'en' => 'Al-Malik', 'meaning' => 'The King'],
            ['ar' => 'الْقُدُّوسُ', 'en' => 'Al-Quddus', 'meaning' => 'The Most Holy'],
            ['ar' => 'السَّلَامُ', 'en' => 'As-Salam', 'meaning' => 'The Source of Peace'],
            ['ar' => 'الْمُؤْمِنُ', 'en' => 'Al-Mu\'min', 'meaning' => 'The Guarantor'],
            ['ar' => 'الْمُهَيْمِنُ', 'en' => 'Al-Muhaymin', 'meaning' => 'The Guardian'],
            ['ar' => 'الْعَزِيزُ', 'en' => 'Al-Aziz', 'meaning' => 'The Almighty'],
            ['ar' => 'الْجَبَّارُ', 'en' => 'Al-Jabbar', 'meaning' => 'The Compeller'],
            ['ar' => 'الْمُتَكَبِّرُ', 'en' => 'Al-Mutakabbir', 'meaning' => 'The Supreme'],
            ['ar' => 'الْخَالِقُ', 'en' => 'Al-Khaliq', 'meaning' => 'The Creator'],
            ['ar' => 'الْبَارِئُ', 'en' => 'Al-Bari', 'meaning' => 'The Evolver'],
            ['ar' => 'الْمُصَوِّرُ', 'en' => 'Al-Musawwir', 'meaning' => 'The Fashioner'],
            ['ar' => 'الْغَفَّارُ', 'en' => 'Al-Ghaffar', 'meaning' => 'The Repeatedly Forgiving'],
            ['ar' => 'الْقَهَّارُ', 'en' => 'Al-Qahhar', 'meaning' => 'The Subduer'],
            ['ar' => 'الْوَهَّابُ', 'en' => 'Al-Wahhab', 'meaning' => 'The Bestower'],
            ['ar' => 'الرَّزَّاقُ', 'en' => 'Ar-Razzaq', 'meaning' => 'The Provider'],
            ['ar' => 'الْفَتَّاحُ', 'en' => 'Al-Fattah', 'meaning' => 'The Opener'],
            ['ar' => 'الْعَلِيمُ', 'en' => 'Al-Alim', 'meaning' => 'The All-Knowing'],
            ['ar' => 'الْقَابِضُ', 'en' => 'Al-Qabid', 'meaning' => 'The Withholder'],
            ['ar' => 'الْبَاسِطُ', 'en' => 'Al-Basit', 'meaning' => 'The Extender'],
            ['ar' => 'الْخَافِضُ', 'en' => 'Al-Khafid', 'meaning' => 'The Reducer'],
            ['ar' => 'الرَّافِعُ', 'en' => 'Ar-Rafi', 'meaning' => 'The Exalter'],
            ['ar' => 'الْمُعِزُّ', 'en' => 'Al-Mu\'izz', 'meaning' => 'The Honourer'],
            ['ar' => 'الْمُذِلُّ', 'en' => 'Al-Mudhill', 'meaning' => 'The Dishonourer'],
            ['ar' => 'السَّمِيعُ', 'en' => 'As-Sami', 'meaning' => 'The All-Hearing'],
            ['ar' => 'الْبَصِيرُ', 'en' => 'Al-Basir', 'meaning' => 'The All-Seeing'],
            ['ar' => 'الْحَكَمُ', 'en' => 'Al-Hakam', 'meaning' => 'The Judge'],
            ['ar' => 'الْعَدْلُ', 'en' => 'Al-Adl', 'meaning' => 'The Just'],
            ['ar' => 'اللَّطِيفُ', 'en' => 'Al-Latif', 'meaning' => 'The Subtle'],
            ['ar' => 'الْخَبِيرُ', 'en' => 'Al-Khabir', 'meaning' => 'The All-Aware'],
            ['ar' => 'الْحَلِيمُ', 'en' => 'Al-Halim', 'meaning' => 'The Forbearing'],
            ['ar' => 'الْعَظِيمُ', 'en' => 'Al-Azim', 'meaning' => 'The Magnificent'],
            ['ar' => 'الْغَفُورُ', 'en' => 'Al-Ghafur', 'meaning' => 'The Forgiving'],
            ['ar' => 'الشَّكُورُ', 'en' => 'Ash-Shakur', 'meaning' => 'The Appreciative'],
            ['ar' => 'الْعَلِيُّ', 'en' => 'Al-Ali', 'meaning' => 'The Most High'],
            ['ar' => 'الْكَبِيرُ', 'en' => 'Al-Kabir', 'meaning' => 'The Greatest'],
            ['ar' => 'الْحَفِيظُ', 'en' => 'Al-Hafiz', 'meaning' => 'The Preserver'],
            ['ar' => 'الْمُقِيتُ', 'en' => 'Al-Muqit', 'meaning' => 'The Nourisher'],
            ['ar' => 'الْحَسِيبُ', 'en' => 'Al-Hasib', 'meaning' => 'The Reckoner'],
            ['ar' => 'الْجَلِيلُ', 'en' => 'Al-Jalil', 'meaning' => 'The Majestic'],
            ['ar' => 'الْكَرِيمُ', 'en' => 'Al-Karim', 'meaning' => 'The Generous'],
            ['ar' => 'الرَّقِيبُ', 'en' => 'Ar-Raqib', 'meaning' => 'The Watchful'],
            ['ar' => 'الْمُجِيبُ', 'en' => 'Al-Mujib', 'meaning' => 'The Responsive'],
            ['ar' => 'الْوَاسِعُ', 'en' => 'Al-Wasi', 'meaning' => 'The All-Encompassing'],
            ['ar' => 'الْحَكِيمُ', 'en' => 'Al-Hakim', 'meaning' => 'The Wise'],
            ['ar' => 'الْوَدُودُ', 'en' => 'Al-Wadud', 'meaning' => 'The Most Loving'],
            ['ar' => 'الْمَجِيدُ', 'en' => 'Al-Majid', 'meaning' => 'The Glorious'],
            ['ar' => 'الْبَاعِثُ', 'en' => 'Al-Ba\'ith', 'meaning' => 'The Resurrector'],
            ['ar' => 'الشَّهِيدُ', 'en' => 'Ash-Shahid', 'meaning' => 'The Witness'],
            ['ar' => 'الْحَقُّ', 'en' => 'Al-Haqq', 'meaning' => 'The Truth'],
            ['ar' => 'الْوَكِيلُ', 'en' => 'Al-Wakil', 'meaning' => 'The Trustee'],
            ['ar' => 'الْقَوِيُّ', 'en' => 'Al-Qawiyy', 'meaning' => 'The Strong'],
            ['ar' => 'الْمَتِينُ', 'en' => 'Al-Matin', 'meaning' => 'The Firm'],
            ['ar' => 'الْوَلِيُّ', 'en' => 'Al-Wali', 'meaning' => 'The Protecting Friend'],
            ['ar' => 'الْحَمِيدُ', 'en' => 'Al-Hamid', 'meaning' => 'The Praiseworthy'],
            ['ar' => 'الْمُحْصِي', 'en' => 'Al-Muhsi', 'meaning' => 'The Accounter'],
            ['ar' => 'الْمُبْدِئُ', 'en' => 'Al-Mubdi', 'meaning' => 'The Originator'],
            ['ar' => 'الْمُعِيدُ', 'en' => 'Al-Mu\'id', 'meaning' => 'The Restorer'],
            ['ar' => 'الْمُحْيِي', 'en' => 'Al-Muhyi', 'meaning' => 'The Giver of Life'],
            ['ar' => 'الْمُمِيتُ', 'en' => 'Al-Mumit', 'meaning' => 'The Bringer of Death'],
            ['ar' => 'الْحَيُّ', 'en' => 'Al-Hayy', 'meaning' => 'The Ever-Living'],
            ['ar' => 'الْقَيُّومُ', 'en' => 'Al-Qayyum', 'meaning' => 'The Sustainer'],
            ['ar' => 'الْوَاجِدُ', 'en' => 'Al-Wajid', 'meaning' => 'The Finder'],
            ['ar' => 'الْمَاجِدُ', 'en' => 'Al-Majid', 'meaning' => 'The Noble'],
            ['ar' => 'الْوَاحِدُ', 'en' => 'Al-Wahid', 'meaning' => 'The One'],
            ['ar' => 'الْأَحَدُ', 'en' => 'Al-Ahad', 'meaning' => 'The Unique'],
            ['ar' => 'الصَّمَدُ', 'en' => 'As-Samad', 'meaning' => 'The Eternal Refuge'],
            ['ar' => 'الْقَادِرُ', 'en' => 'Al-Qadir', 'meaning' => 'The Able'],
            ['ar' => 'الْمُقْتَدِرُ', 'en' => 'Al-Muqtadir', 'meaning' => 'The Powerful'],
            ['ar' => 'الْمُقَدِّمُ', 'en' => 'Al-Muqaddim', 'meaning' => 'The Expediter'],
            ['ar' => 'الْمُؤَخِّرُ', 'en' => 'Al-Mu\'akhkhir', 'meaning' => 'The Delayer'],
            ['ar' => 'الْأَوَّلُ', 'en' => 'Al-Awwal', 'meaning' => 'The First'],
            ['ar' => 'الْآخِرُ', 'en' => 'Al-Akhir', 'meaning' => 'The Last'],
            ['ar' => 'الظَّاهِرُ', 'en' => 'Az-Zahir', 'meaning' => 'The Manifest'],
            ['ar' => 'الْبَاطِنُ', 'en' => 'Al-Batin', 'meaning' => 'The Hidden'],
            ['ar' => 'الْوَالِي', 'en' => 'Al-Wali', 'meaning' => 'The Governor'],
            ['ar' => 'الْمُتَعَالِي', 'en' => 'Al-Muta\'ali', 'meaning' => 'The Most Exalted'],
            ['ar' => 'الْبَرُّ', 'en' => 'Al-Barr', 'meaning' => 'The Source of Goodness'],
            ['ar' => 'التَّوَّابُ', 'en' => 'At-Tawwab', 'meaning' => 'The Accepter of Repentance'],
            ['ar' => 'الْمُنْتَقِمُ', 'en' => 'Al-Muntaqim', 'meaning' => 'The Avenger'],
            ['ar' => 'الْعَفُوُّ', 'en' => 'Al-Afuww', 'meaning' => 'The Pardoner'],
            ['ar' => 'الرَّءُوفُ', 'en' => 'Ar-Ra\'uf', 'meaning' => 'The Kind'],
            ['ar' => 'مَالِكُ الْمُلْكِ', 'en' => 'Malik-ul-Mulk', 'meaning' => 'Owner of the Kingdom'],
            ['ar' => 'ذُو الْجَلَالِ وَالْإِكْرَامِ', 'en' => 'Dhul-Jalali wal-Ikram', 'meaning' => 'Lord of Majesty and Honour'],
            ['ar' => 'الْمُقْسِطُ', 'en' => 'Al-Muqsit', 'meaning' => 'The Equitable'],
            ['ar' => 'الْجَامِعُ', 'en' => 'Al-Jami', 'meaning' => 'The Gatherer'],
            ['ar' => 'الْغَنِيُّ', 'en' => 'Al-Ghani', 'meaning' => 'The Self-Sufficient'],
            ['ar' => 'الْمُغْنِي', 'en' => 'Al-Mughni', 'meaning' => 'The Enricher'],
            ['ar' => 'الْمَانِعُ', 'en' => 'Al-Mani', 'meaning' => 'The Preventer'],
            ['ar' => 'الضَّارُّ', 'en' => 'Ad-Darr', 'meaning' => 'The Distresser'],
            ['ar' => 'النَّافِعُ', 'en' => 'An-Nafi', 'meaning' => 'The Benefactor'],
            ['ar' => 'النُّورُ', 'en' => 'An-Nur', 'meaning' => 'The Light'],
            ['ar' => 'الْهَادِي', 'en' => 'Al-Hadi', 'meaning' => 'The Guide'],
            ['ar' => 'الْبَدِيعُ', 'en' => 'Al-Badi', 'meaning' => 'The Incomparable'],
            ['ar' => 'الْبَاقِي', 'en' => 'Al-Baqi', 'meaning' => 'The Everlasting'],
            ['ar' => 'الْوَارِثُ', 'en' => 'Al-Warith', 'meaning' => 'The Inheritor'],
            ['ar' => 'الرَّشِيدُ', 'en' => 'Ar-Rashid', 'meaning' => 'The Guide to the Right Path'],
            ['ar' => 'الصَّبُورُ', 'en' => 'As-Sabur', 'meaning' => 'The Patient'],
        ];
        return view(activeTemplate() . 'prayer.names', compact('pageTitle', 'names'));
    }

    public function hijri()
    {
        $pageTitle = 'Hijri Calendar';
        return view(activeTemplate() . 'prayer.hijri', compact('pageTitle'));
    }
}
