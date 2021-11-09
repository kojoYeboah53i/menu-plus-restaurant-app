import XLSX from 'xlsx'

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
  },
})

$(document).ready(() => {
  $('.mobile-menu-button').click(() => {
    $('.sidebar').toggleClass('-translate-x-full')
  })
  $(document).on('change', '#allSubscriptionCheckbox', function () {
    const ALLCHECKBOX = $(this)
    const CHECKBOXES = ALLCHECKBOX.parent().siblings()
    console.log(CHECKBOXES)
    CHECKBOXES.each(function () {
      const SIBLINGCHECKBOX = $(this).find('input')
      const CHECKEDVALUE = ALLCHECKBOX.is(':checked')
      SIBLINGCHECKBOX.prop('checked', CHECKEDVALUE)
      console.log(SIBLINGCHECKBOX.attr('checked'))
    })
  })
  $(document).on('change', '.subscriptionCheckbox', function () {
    const CURRENTCHECKBOX = $(this)
    const CHECKBOXES = CURRENTCHECKBOX.parent()
      .siblings()
      .not('#allCheckboxParent')
    let checked_counter = 0
    CHECKBOXES.each(function () {
      const SIBLINGCHECKBOX = $(this).find('input')
      SIBLINGCHECKBOX.is(':checked') ? checked_counter++ : ''
    })
    CURRENTCHECKBOX.is(':checked') ? checked_counter++ : ''
    $('#allSubscriptionCheckbox').prop(
      'checked',
      checked_counter === CHECKBOXES.length + 1,
    )
  })
  $(document).on('click', '#updateWaiterBtn', function (e) {
    console.log($(this))
    e.preventDefault()
    e.stopImmediatePropagation()
    const btn = $(this)
    const url = btn.data('url')
    const id = btn.data('id')
    const values = $(`.input-value${id}`)
    console.log(values)
    const inputs = {}
    $.each(values, function () {
      if ($(this).is(':checked')) {
        inputs[$(this).attr('name')] = $(this).data('val')
      }
    })

    $.ajax({
      url: url,
      type: 'PUT',
      data: inputs,
      dataType: 'JSON',
      async: true,
      success: function (response) {
        console.log(response)
        location.href = response.url
      },
      error: function (response) {
        console.log(response)
        location.href = response.url
      },
    })
  })
  $(document).on('change', '.select-customer', function () {
    const customer = $(this)
    const checked = $(this).is(':checked')
    getTotalSelectedCustomers() > 0
      ? $('#downloadCustomerBtn').show()
      : $('#downloadCustomerBtn').hide()
  })
  function getTotalSelectedCustomers() {
    return $('.select-customer:checkbox:checked').length
  }
  $(document).on('click', '#downloadCustomerBtn', function () {
    let exportData = []
    $.each($('.customersList'), function () {
      const customersList = $(this)
      if (customersList.find('input').is(':checked')) {
        const customersData = customersList.find('.customersData').children()
        const data = {}
        $.each(customersData, function (i) {
          if (i === 0 && !$(this).find('input').is(':checked')) {
            return true
          }
          if (i !== 0) {
            data[$(this).data('val')] = $(this).html()
          }
        })
        exportData.push(data)
      }
    })
    const worksheet = XLSX.utils.json_to_sheet(exportData)
    /* generate workbook and add the worksheet */
    const workbook = XLSX.utils.book_new()
    XLSX.utils.book_append_sheet(workbook, worksheet, `Customers`)
    /* save to file */
    const extension = 'xlsx'
    const fileName = `Customers.${extension}`
    XLSX.writeFile(workbook, fileName, {
      bookType: extension,
      type: 'buffer',
    })
  })
  // Datepicker initializer
  $('#booking-calender').datetimepicker({
    inline: true,
    format: 'YYYY-MM-DD',
    sideBySide: true,
    icons: {
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
    },
  })
  $('#booking-calender').on('dp.change', function (e) {
    const url = $('meta[name="booking-url"]').attr('content')
    $.ajax({
      url,
      type: 'GET',
      data: { date: moment(e.date).format('YYYY-MM-DD') },
      success: function (response) {
        console.log(response)
        $('#selectedBooking').html(response)
      },
      error: function (response) {
        console.log(response)
      },
    })
  })
})

window.confirmAction = function (form, event) {
  if (confirm('Are you sure you want to perform this resource?')) {
    const formElement = document.getElementById(form)
    formElement.setAttribute('action', event.target.dataset.url)
    formElement.submit()
  }
}

window.loadImagePreview = function (input, id) {
  id = id || '#imagePreview'
  if (input.files && input.files[0]) {
    var reader = new FileReader()
    reader.onload = function (e) {
      $(id).attr('src', e.target.result)
    }
    reader.readAsDataURL(input.files[0])
    $('#imagePreview').show()
    $('#uploadImageBlock').hide()
  }
}

window.loadFile = function (event) {
  var uploadBlock = document.getElementById('uploadImageBlock')
  uploadBlock.style.display = 'none'
  var image = document.getElementById('imagePreview')
  image.style.display = 'block'
  image.src = URL.createObjectURL(event.target.files[0])
}

window.loadSelfImagePreview = function (input, id) {
  id = id || '#selfImagePreview'
  if (input.files && input.files[0]) {
    var reader = new FileReader()
    reader.onload = function (e) {
      $(id).attr('src', e.target.result)
    }
    reader.readAsDataURL(input.files[0])
    $('#selfImagePreview').show()
    $('#selfUploadImageBlock').hide()
    $('#selfUploadForm').submit()
  }
}

