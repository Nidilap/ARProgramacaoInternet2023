async function removeItem(item) {
    $(item).fadeOut();
    await wait(1000);
    $(item).remove();
}

function wait(time) {
    return new Promise(resolve => {
        setTimeout(() => {
            resolve();
        }, time);
    });
}

function validateField(item) {
    var value = item.val();
    var type = item.attr("type");
    var invalid = false;

    if (value !== "") {
        item.parent().addClass("before-visible");
    } else if (value === "") {
        item.parent().removeClass("before-visible");
    }

    if (type === "text") {
        if (value === "") { //text validator
            invalid = true;
        }
    } else if (type === "email") {
        if (value === "") { //email validator
            invalid = true;
        }
    } else if (type === "password") {
        if (value === "") { //email validator
            invalid = true;
        }
    } else if (type === "address") {
        if (value === "") { //email validator
            invalid = true;
        }
    }
    if (type === "date") {
        if (value === "") { //text validator
            invalid = true;
        }
    } else if (type === "file") {
        if (value === "") { //email validator
            invalid = true;
            item.siblings().addClass("invalid");
        } else {
            item.siblings().removeClass("invalid");
        }
    } else if (type === "select" || item.prop("tagName").toLowerCase() === 'select') {
        if (value === "") { //email validator
            invalid = true;
            item.siblings().addClass("invalid");
        } else {
            item.siblings().removeClass("invalid");
        }
    } //else if(type === ""){ //other validator
    //  
    //}
    if (invalid) {
        if (item.parent().parent().find(".invalidButton").length === 0) { 
            item.addClass("invalid");
            item.parent().parent().prepend("<label class='invalidButton fa fa-exclamation float-icon waves-circle waves-float bg-danger op-0-6 invalidIcon' for=" + item.attr("id") + " onclick='removeItem(this);'></label>");
        }
        event.preventDefault();
        return false;
    } else {
        removeItem(item.parent().parent().find(".invalidButton"));
        item.removeClass("invalid");
        return true;
    }
    //alert("OK");
}

function b64toBlob(b64Data, contentType, sliceSize) {
    contentType = contentType || '';
    sliceSize = sliceSize || 512;
  
    var byteCharacters = atob(b64Data);
    var byteArrays = [];
  
    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
      var slice = byteCharacters.slice(offset, offset + sliceSize);
  
      var byteNumbers = new Array(slice.length);
      for (var i = 0; i < slice.length; i++) {
        byteNumbers[i] = slice.charCodeAt(i);
      }
  
      var byteArray = new Uint8Array(byteNumbers);
  
      byteArrays.push(byteArray);
    }
  
    var blob = new Blob(byteArrays, {type: contentType});
    return blob;
  }


jQuery.document_ready (function() {
    //init Waves mode for compoent
    Waves.attach('.btn'); //, ['waves-button', 'waves-float', 'waves-purple']
    //Waves.attach('.float-icon');
    Waves.init();


    $('[data-toggle="tooltip"]').tooltip()

    $(".validate").on("change paste keyup select", function() { 
        validateField($(this));
    });

    $('input[type="file"]').on('change', function() {
        var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
        $(this).siblings(".custom-file-label").text(filename);
    });

});
