Validator({
    form: '#addProductForm',
    errorMessage: '.form-message',
    rules: [
        Validator.isRequired('#productName', 'Vui lòng không để trống'),
        Validator.isNameField('#productName', 'Tên không hợp lệ'),
        Validator.isMinlength('#productName', 2, 'Tên không nhỏ hơn 2 kí tự'),



    ]
});