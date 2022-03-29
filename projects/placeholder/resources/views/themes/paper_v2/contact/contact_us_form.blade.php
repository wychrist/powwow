@extends('theme_layout::landing')

@section('section3')
<div class="container">
    <div class="row">
        @isset($success)
        <div class="col">
            <div class="card card-profile">
                <div class="card-body">
                    <div class="author">
                        <h2 class="card-title">Thank You for your Request</h2>
                        <h6 class="card-category">cat</h6>
                    </div>
                    <p class="card-description text-center">
                        Please verify your email address within the next 24 hours so your message can be directed to the correct person.
                    </p>
                </div>
            </div>
        </div>
        @endisset

        @empty($success)
        <div class="col">
            <h2 class="text-center no-margin"></h2>
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
                    <textarea name="data[message]" placeholder="Message ..." class="form-control" style="border-bottom-right-radius: 0px;" id="contact_message"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" value="Submit" class="btn btn-danger btn-round">Submit</button>
                </div>
            </form>
        </div>
        @endempty
    </div>
</div>
@endsection