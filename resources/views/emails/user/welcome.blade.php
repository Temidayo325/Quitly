@component('mail::message')
# Takeaquiz is a tutor's dream come true!

Hi {{$name}}!
Welcome to Takeaquiz! With our platform, you can create, manage and mark multiple choice questions for your class.
 We've made it easy for you to get started. 
Here's how to create questions:
1) Click on the course link on your dashboard to create a course.
2) Click on the Create course button.
3) Enter the course name and click the create button.
3) Click the Question link on your dashboard (by your left). 
4) Click the course to add questions and then edit the timeline for your quiz test. 


@component('mail::panel')
Best of luck with your classes! We're here to help if you need any assistance along the way. 
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
