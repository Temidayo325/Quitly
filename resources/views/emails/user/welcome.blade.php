@component('mail::message')
<img src=' http://127.0.0.1:8000/images/pexels-cottonbro-3826676-compressed.jpg' alt="Quizly welcome banner ">

<h1 style="margin-top: 20px">Hey {{$name}} 😍😍!</h1>

Welcome to Quizly 🤝🤝, we offer you exciting assessments in your chosen course of study to test your reading comprehension per each topic available. It is free to get started
Have fun using platform and don't forget to tell your friends about it if you find it helpful 🥺🥺

@component('mail::panel')
Reduce your chance of seeing shege with Quizly in your tests and exams with Quizly 😁😁.
@endcomponent

Thanks,<br>
Theresa from {{ config('app.name') }}
@endcomponent
