@extends('theme_layout::contact_us')

<?php
$flash = app('Modules\CongregateContract\Theme\FlashMessageInterface');
$privacyUrl = \Modules\CongregateCms\Services\Url::page('privacy');
/*$confirmMessage = $flash->get('contact_us_form_confirm');

    if($confirmMessage) {
        dump($confirmMessage);
    } */
?>

@section('contact_form')
<div class="container">
    <div class="contact-us-gap"></div>
    <div class="row">

        @if($flash->hasSuccess())
        <?php $success = $flash->getSuccess(); ?>
        <div class="col contact-us-success">
            <h1 class="text-center title">
                Thank You {{$success['context']['data']['first_name']}} for your Submission
            </h1>
            <h3 class="text-center">Your {{$success['context']['type']}} request is being processed.</h3>
            <p class="card-description text-center">
                Please verify your email address within the next 24 hours so your message can be directed to the correct person. Otherwise your message will be rejected.
            </p>
            <p class='button-flex-box'>
                <a class="no-margin btn btn-danger btn-move-right btn-round" href="/">
                    Home
                    <i class="nc-icon nc-minimal-right"></i>
                </a>
            </p>
        </div>

        @else
        <div class="col">
            <h1 class="text-center title">
                Contact Us
            </h1>
            <form method="post">
                @csrf
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="contact_first_name" class="contact-form-label">First Name:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text form-left-pill">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <input type="text" name="data[first_name]" placeholder="John" class="form-control" id="contact_first_name" />
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contact_last_name" class="contact-form-label">Last Name:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text form-left-pill">
                                </span>
                            </div>
                            <input type="text" name="data[last_name]" placeholder="Doe" class="form-control" id="contact_last_name" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_email" class="contact-form-label">Email:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text form-left-pill">
                                <i class="fa fa-envelope-o"></i>
                            </span>
                        </div>
                        <input required type="email" name="email" placeholder="john.doe@example.com" class="form-control" id="contact_email" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_type" class="contact-form-label">Nature of Contact:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text form-left-pill">
                            </span>
                        </div>
                        <select required name="type" class="form-control" class="form-control" id="contact_type">
                            <option selected>General</option>
                            <option>Prayer Request</option>
                            <option>Worship Details</option>
                            <option>Spiritual Question</option>
                            <option>Request Document</option>
                        </select>
                        <div class="input-group-append">
                            <span class="input-group-text form-right-pill">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_message" class="contact-form-label">Message:</label>
                    <textarea name="data[message]" placeholder="Message ..." class="form-control contact-us-textarea" id="contact_message"></textarea>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="consent_contact_us" data-toggle="tooltip" data-placement="bottom" data-original-title="Consent to Privacy Policy">
                        <input class="form-check-input" type="checkbox" name="consent_contact_us" value="" alt="Consent to Privacy Policy" aria-label="Consent to Privacy Policy" required id="consent_contact_us">
                        Consent to
                        <span class="form-check-sign"></span>
                    </label>
                    <a class="privacy-policy-padding" href="{{ $privacyUrl }}"> Privacy Policy</a>
                </div>
                <div class="form-group button-flex-box">
                    <button type="submit" value="Submit" class="btn btn-danger btn-round btn-move-right">Submit</button>
                </div>
            </form>
        </div>
        @endif

    </div>
</div>
@endsection