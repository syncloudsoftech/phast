<?php $this->layout('_main', ['title' => 'Home']) ?>

<h1 class="mb-3">Home</h1>
<div x-data="{ name: '<?= $this->e($name) ?>' }">
    <div class="row mb-3">
        <div class="col-md-8 col-lg-6 col-xl-4">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
                <!--suppress HtmlFormInputWithoutLabel -->
                <input type="text" class="form-control" placeholder="Enter your name" x-model="name">
            </div>
        </div>
    </div>
    <p class="mb-0">Hey, <span x-text="name"></span> I hope you are feeling good today.</p>
</div>
