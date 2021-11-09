window.addEventListener("DOMContentLoaded", () => {

    //render app logo here
    const applogo = document.querySelector('.appLogo');
    applogo.style.imageRendering = '-webkit-optimize-contrast';

})

$(document).ready(() => {
    $(".mobile-menu-button").click(() => {
        $(".sidebar").toggleClass("-translate-x-full");
    });
    $(document).on("change", "#allSubscriptionCheckbox", function () {
        const ALLCHECKBOX = $(this);
        const CHECKBOXES = ALLCHECKBOX.parent().siblings();
        console.log(CHECKBOXES);
        CHECKBOXES.each(function () {
            const SIBLINGCHECKBOX = $(this).find("input");
            const CHECKEDVALUE = ALLCHECKBOX.is(":checked");
            SIBLINGCHECKBOX.prop("checked", CHECKEDVALUE);
            console.log(SIBLINGCHECKBOX.attr("checked"));
        });
    });
    $(document).on("change", ".subscriptionCheckbox", function () {
        const CURRENTCHECKBOX = $(this);
        const CHECKBOXES = CURRENTCHECKBOX.parent()
            .siblings()
            .not("#allCheckboxParent");
        let checked_counter = 0;
        CHECKBOXES.each(function () {
            const SIBLINGCHECKBOX = $(this).find("input");
            SIBLINGCHECKBOX.is(":checked") ? checked_counter++ : "";
        });
        CURRENTCHECKBOX.is(":checked") ? checked_counter++ : "";
        $("#allSubscriptionCheckbox").prop(
            "checked",
            checked_counter === CHECKBOXES.length + 1
        );
    });
});

window.confirmDelete = function (form, event) {
    if (confirm("Are you sure you want to delete this resource?")) {
        const formElement = document.getElementById(form);
        formElement.setAttribute("action", event.target.parentNode.dataset.url);
        formElement.submit();
    }
};

window.loadImagePreview = function (input, id) {
    id = id || "#imagePreview";
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(id).attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
        $("#imagePreview").show();
        $("#uploadImageBlock").hide();
        $("#existingImg").hide();
    }
};

// window.loadSelfImagePreview = function (input, id) {
//     console.log(12345);
//     id = id || "#selfImagePreview";
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             $(id).attr("src", e.target.result);
//         };
//         reader.readAsDataURL(input.files[0]);
//         $("#selfImagePreview").show();
//         $("#selfUploadImageBlock").hide();
//         $("#selfUploadForm").submit();
//     }
// };





$(function () {
console.log("customjs is successfully loaded")

})
