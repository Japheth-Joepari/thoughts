<div>
    <section class="main-content p-2">
        <div class="container-xl">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <!-- contact info item -->
                    <div class="contact-item bordered rounded d-flex align-items-center">
                        <span class="icon icon-phone"></span>
                        <div class="details" id="sction">
                            <h3 class="mb-0 mt-0">Phone</h3>
                            <p class="mb-0">+234-704-197-0128</p>
                        </div>
                    </div>
                    <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                </div>

                <div class="col-md-4">
                    <!-- contact info item -->
                    <div class="contact-item bordered rounded d-flex align-items-center">
                        <span class="icon icon-envelope-open"></span>
                        <div class="details">
                            <h3 class="mb-0 mt-0">E-Mail</h3>
                            <p class="mb-0">japhethjoepariagidife@gmail.com</p>
                        </div>
                    </div>
                    <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                </div>

                <div class="col-md-4">
                    <!-- contact info item -->
                    <div class="contact-item bordered rounded d-flex align-items-center">
                        <span class="icon icon-map"></span>
                        <div class="details">
                            <h3 class="mb-0 mt-0">Location</h3>
                            <p class="mb-0">Lagos, Nigeria</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="spacer" data-height="50"></div>

            <!-- section header -->
            <div class="section-header">
                <h3 class="section-title">Send Message</h3>
                <img src="images/wave.svg" class="wave" alt="wave" />
            </div>

            <!-- Contact Form -->
            <form wire:submit.prevent="submitForm" class="contact-form">
                <div class="messages"></div>

                <div class="row">
                    <div class="column col-md-6">
                        <!-- Name input -->
                        <div class="form-group">
                            <input type="text" wire:model="name" class="form-control" name="InputName" id="InputName"
                                placeholder="Your name" required="required" data-error="Name is required." />
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="column col-md-6">
                        <!-- Email input -->
                        <div class="form-group">
                            <input type="email" wire:model="email" class="form-control" id="InputEmail"
                                name="InputEmail" placeholder="Email address" required="required"
                                data-error="Email is required." />
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="column col-md-12">
                        <!-- Subject input -->
                        <div class="form-group">
                            <input type="text" wire:model="subject" class="form-control" id="InputSubject"
                                name="InputSubject" placeholder="Subject" required="required"
                                data-error="Subject is required." />
                            <div class="help-block with-errors"></div>
                        </div>


                        <div class="column col-md-12">
                            <!-- Message textarea -->
                            <div class="form-group">
                                <textarea name="InputMessage" wire:model="message" id="InputMessage" class="form-control" rows="4"
                                    placeholder="Your message here..." required="required" data-error="Message is required."></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <button class=" btn btn-default">
                        Submit Message</button><!-- Send Button -->
            </form>
            <!-- Contact Form end -->
        </div>
    </section>
