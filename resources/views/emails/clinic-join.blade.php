@component('mail::message')
# Join {{$clinic->name}}

You have received an invitation to join a clinic as a veterinarian on Ababu, the free veterinary clinical record
software.
Just login to the platform and click the button / link belove.

@component('mail::button', ['url' => route('clinics.enroll', ['token' => $token]) ])
Join
@endcomponent

or insert the code:<br>
<h3>{{ $token }}</h3>

in the "join existing clinic" form.

<h5>
    Thanks, شكراً لك, 谢谢, hvala vam, děkuji, tak, dank je, thank you, aitäh, dankon, kiitos, merci, danke, ευχαριστώ,
    mahalo, धन्यवाद|, terima kasih, grazie, paldies, takk, dziękuję, obrigado/obrigada, mulţumesc, cпасибо, gracias,
    asante, teşekkür ederim, Cảm ơn anh., dankie, faleminderit, Շնորհակալություն, hvala ti, благодаря, gràcies, 多 謝,
    תודה, köszönöm, takk, شكراً لك, ačiū, Благодарам, grazzi, баярлалаа, xвала / Hvala, hvala vam, tack, நன்றி, Дякую,
    diolch, אַ דאַנק, ngiyabonga, faleminderit, Grazias, Sağ ol, eskerrik asko, Дзякуй, ধন্যবাদ।, trugéré, Akeva, ေက်း
    ဇူး ပါ, Salamat, zikomo, متشکرم, salamat, Grazas, გმადლობ, આભાર, mèsi poutèt ou, na gode, daalụ, go raibh maith
    agat, matur nuwun, ನಿಮಗೆ ಧನ್ಯವಾದಗಳು, អរ គុណ។, ຂໍຂອບໃຈທ່ານ, gratias tibi ago, misaotra, നന്ദി, Dhanyawaadh, Welálin,
    barka, Ahéhee', धन्यवाद।, miigwetch, manana, متشکرم, ਤੁਹਾਡਾ ਧੰਨਵਾਦ।, tapadh leat, ďakujem, waad ku mahadsan tahay,
    rahmat, ధన్యవాదాలు, tualumba, Спасибі, آپ کا شکریہ
</h5>
<br>
{{ config('app.name') }}
@endcomponent