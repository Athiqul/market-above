<?php if(session()->has('warning') && is_string(session()->get('warning'))):?>
                  <div
                  class="alert alert-danger alert-dismissible fade show"
                  role="alert"
                >
                  <strong>Warning!</strong> <?=session()->get('warning')?>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                  ></button>
                </div>
<?php endif?>
<?php if(session()->has('warning') && is_object(session()->get('warning'))):?>

<?php foreach(session()->get('warning') as $item):?>
  <div
                class="alert alert-danger alert-dismissible fade show"
                role="alert"
              >
                <strong>Warning!</strong> <?=$item?>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="alert"
                  aria-label="Close"
                ></button>
              </div>
<?php endforeach?>
<?php endif?>
<?php if(session()->has('success')):?>
                  <div
                  class="alert alert-success alert-dismissible fade show"
                  role="alert"
                >
                  <strong>Warning!</strong> <?=session()->get('success')?>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                  ></button>
                </div>
<?php endif?>