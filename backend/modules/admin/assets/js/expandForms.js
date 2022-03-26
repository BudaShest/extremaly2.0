let $togglers = document.querySelectorAll('.expand-toggler');

$togglers.forEach($toggler=>$toggler.addEventListener('click', function (e){
    let $form = document.querySelector(`#${e.target.dataset.target}`);
    $form.classList.toggle('expand-form-active');
}))
//TODO