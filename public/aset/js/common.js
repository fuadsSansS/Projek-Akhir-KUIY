let uploadedFiles = new FormData();
function alertConfirmDelete(message, route, redirect) {
    return Swal.fire({
        title: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.value) {
            // If confirmed, proceed with the deletion
            axios.delete(route)
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', redirect, 1500)
                    } else {
                        alertError(response.data.responseMessage, true)
                    }
                })
                .catch(function (error) {
                    alertError(error)
                });
        }
    });
}

function alertConfirmPilih(message, route, redirect) {
    return Swal.fire({
        title: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
    }).then((result) => {
        if (result.value) {
            // If confirmed, proceed with the selection
            axios.post(route)
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', redirect, 1500)
                    } else {
                        alertError(response.data.responseMessage, true)
                    }
                })
                .catch(function (error) {
                    alertError(error)
                });
        }
    });
}

function alertTimeout(message, icon, route, timeout) {
    Swal.fire({
        title: message,
        icon: icon,
        timer: timeout,
        timerProgressBar: true,
        showConfirmButton: false,
    }).then(() => {
        // Redirect after the timeout
        window.location.href = route;
    });
}

function alertInfo(message) {
    Swal.fire({
        title: message,
        icon: "info",
        timer: 1000,
        timerProgressBar: false,
        showConfirmButton: false,
    });
}

function alertError(message, reload) {
    Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error',
        allowOutsideClick: false,
        allowEscapeKey: false,
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed && reload) {
            window.location.reload();
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Pilih Keimigrasian Action
    const pilihKeimigrasianButton = document.querySelectorAll('.pilih-keimigrasian');
    pilihKeimigrasianButton.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/keimigrasian/pilih/' + id;
            const redirect = ''
            alertConfirmPilih("Pilih Keimigrasian?", route, redirect);
        });
    });

    // Pilih Homestay Action
    const pilihHomestayButton = document.querySelectorAll('.pilih-homestay');
    pilihHomestayButton.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/homestay/pilih/' + id;
            const redirect = ''
            alertConfirmPilih("Pilih Homestay?", route, redirect);
        });
    });

    const pilihDormitoryButton = document.querySelectorAll('.pilih-dormitory');
    pilihDormitoryButton.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/dormitory/pilih/' + id;
            const redirect = ''
            alertConfirmPilih("Pilih Dormitory?", route, redirect);
        });
    });

    const pilihHotelButton = document.querySelectorAll('.pilih-hotel');
    pilihHotelButton.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/hotel/pilih/' + id;
            const redirect = ''
            alertConfirmPilih("Pilih Hotel?", route, redirect);
        });
    });


    // Pilih Asuransi Action
    const pilihAsuransiButton = document.querySelectorAll('.pilih-asuransi');
    pilihAsuransiButton.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/asuransi/pilih/' + id;
            const redirect = ''
            alertConfirmPilih("Pilih Asuransi?", route, redirect);
        });
    });

    // Delete Asuransi Action
    const deleteAsuransiButtons = document.querySelectorAll('#delete-asuransi');
    deleteAsuransiButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            console.log(id)
            const route = '/asuransi/delete/' + id;
            const redirect = 'asuransi'
            alertConfirmDelete("Delete Asuransi?", route, redirect);
        });
    });

    // Delete Rincian Keimigrasian Action
    //# itu mengemabil berdasrkan id
    const deleteRincianKeimigrasianButtons = document.querySelectorAll('#delete-rincian-keimigrasian');
    deleteRincianKeimigrasianButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/rincian/delete-keimigrasian/' + id;
            const redirect = ''
            alertConfirmDelete("Delete Pilihan Keimigrasian?", route, redirect);
        });
    });

    // Delete Rincian Asuransi Action
    const deleteRincianAsuransiButtons = document.querySelectorAll('#delete-rincian-asuransi');
    deleteRincianAsuransiButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/rincian/delete-asuransi/' + id;
            const redirect = ''
            alertConfirmDelete("Delete Pilihan Asuransi?", route, redirect);
        });
    });

    // Delete Rincian Homestay Action
    const deleteRincianHomestayButtons = document.querySelectorAll('#delete-rincian-homestay');
    deleteRincianHomestayButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/rincian/delete-homestay/' + id;
            const redirect = ''
            alertConfirmDelete("Delete Pilihan Homestay?", route, redirect);
        });
    });

    const deleteRincianHotelButtons = document.querySelectorAll('#delete-rincian-hotel');
    deleteRincianHotelButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/rincian/delete-hotel/' + id;
            const redirect = ''
            alertConfirmDelete("Delete Pilihan Hotel?", route, redirect);
        });
    });



    // Delete Keimigrasian Action
    const deleteKeimigrasianButtons = document.querySelectorAll('#delete-keimigrasian');
    deleteKeimigrasianButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/keimigrasian/delete/' + id;
            const redirect = 'keimigrasian'
            alertConfirmDelete("Delete Keimigrasian?", route, redirect);
        });
    });

    // Delete Homestay Action
    const deleteHomestayButtons = document.querySelectorAll('#delete-homestay');
    deleteHomestayButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/homestay/delete/' + id;
            const redirect = 'homestay'
            alertConfirmDelete("Delete homestay?", route, redirect);
        });
    });

    const deleteDormitoryButtons = document.querySelectorAll('rincian-dormitory');
    deleteDormitoryButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/dormitory/delete/' + id;
            const redirect = 'dormitory'
            alertConfirmDelete("Delete dormitory?", route, redirect);
        });
    });

    const deleteHotelButtons = document.querySelectorAll('#delete-hotel');
    deleteHotelButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/hotel/delete/' + id;
            const redirect = 'hotel'
            alertConfirmDelete("Delete hotel?", route, redirect);
        });
    });

    const deleteVisaButtons = document.querySelectorAll('#delete-visa');
    deleteVisaButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const id = this.getAttribute('value');
            const route = '/visa/delete/' + id;
            const redirect = 'visa'
            alertConfirmDelete("Delete visa?", route, redirect);
        });
    });

    // Create Visa Action
    const createVisaForm = document.getElementById('create-visa');
    if (createVisaForm) {
        addEventListener('submit', function (event) {
            event.preventDefault();

            // Get form data
            const formData = new FormData(createVisaForm);
            var totalFile = 0;

            for (const [key, value] of uploadedFiles.entries()) {
                if (totalFile > 1) {
                    return;
                }
                formData.append('files[]', value);
                totalFile++;
            }
            if (formData.getAll('files[]').length === 0) {
                alertInfo("Please upload a file")
                return;
            }

            // Axios request
            axios.post('/visa/save', formData)
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', '/visa', 1500)
                    } else {
                        alertError(response.data.responseMessage, false)
                    }
                })
                .catch(function (error) {
                    alertError(error, false)
                    console.error(error);
                });
        });
    }

    //Create Asuransi Action
    const createAsuransiForm = document.getElementById('create-asuransi');
    if (createAsuransiForm) {
        addEventListener('submit', function (event) {
            event.preventDefault();

            // Get form data
            const formData = new FormData(createAsuransiForm);
            console.log(formData)
            // Axios request
            axios.post('/asuransi/save', formData)
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', '/asuransi', 1500)
                    } else {
                        alertError(response.data.responseMessage, false)
                    }
                })
                .catch(function (error) {
                    alertError(error, false)
                    console.error(error);
                });
        });
    }

    // Create Keimigrasian Action
    const createKeimigrasianForm = document.getElementById('create-keimigrasian');
    if (createKeimigrasianForm) {
        addEventListener('submit', function (event) {
            event.preventDefault();
            const totalBiayaInput = document.getElementById('totalBiaya');
            const totalBiaya = parseInt(totalBiayaInput.value.replace(/[^0-9]/g, ''), 10) || 0;


            // Get form data
            const formData = new FormData(createKeimigrasianForm);
            formData.append('total_biaya', totalBiaya)
            console.log(formData.get('biaya_keimigrasian'))
            console.log(formData.get('biaya_kemenaker'))
            console.log(formData.get('total_biaya'))
            // Axios request
            axios.post('/keimigrasian/save', formData)
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', '/keimigrasian', 1500)
                    } else {
                        alertError(response.data.responseMessage, false)
                    }
                })
                .catch(function (error) {
                    alertError(error, false)
                    console.error(error);
                });
        });
    }

    // Create Homestay Action
    const createHomestayForm = document.getElementById('create-homestay');
    if (createHomestayForm) {
        addEventListener('submit', function (event) {
            event.preventDefault();

            // Get form data
            const formData = new FormData(createHomestayForm);
            var totalPhoto = 0;

            for (const [key, value] of uploadedFiles.entries()) {
                if (totalPhoto > 5) {
                    return;
                }
                formData.append('files[]', value);
                totalPhoto++;
            }
            if (formData.getAll('files[]').length === 0) {
                alertInfo("Please upload a photo")
                return;
            }

            // Axios request
            axios.post('/homestay/save', formData)
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', '/homestay', 1500)
                    } else {
                        alertError(response.data.responseMessage, false)
                    }
                })
                .catch(function (error) {
                    alertError(error, false)
                    console.error(error);
                });
        });
    }

    const createDormitoryForm = document.getElementById('create-dormitory');
    if (createDormitoryForm) {
        addEventListener('submit', function (event) {
            event.preventDefault();

            // Get form data
            const formData = new FormData(createDormitoryForm);
            var totalPhoto = 0;

            for (const [key, value] of uploadedFiles.entries()) {
                if (totalPhoto > 5) {
                    return;
                }
                formData.append('files[]', value);
                totalPhoto++;
            }
            if (formData.getAll('files[]').length === 0) {
                alertInfo("Please upload a photo")
                return;
            }

            // Axios request
            axios.post('/dormitory/save', formData)
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', '/dormitory', 1500)
                    } else {
                        alertError(response.data.responseMessage, false)
                    }
                })
                .catch(function (error) {
                    alertError(error, false)
                    console.error(error);
                });
        });
    }

    const createHotelForm = document.getElementById('create-hotel');
    if (createHotelForm) {
        addEventListener('submit', function (event) {
            event.preventDefault();

            // Get form data
            const formData = new FormData(createHotelForm);
            var totalPhoto = 0;

            for (const [key, value] of uploadedFiles.entries()) {
                if (totalPhoto > 5) {
                    return;
                }
                formData.append('files[]', value);
                totalPhoto++;
            }
            if (formData.getAll('files[]').length === 0) {
                alertInfo("Please upload a photo")
                return;
            }

            // Axios request
            axios.post('/hotel/save', formData)
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', '/hotel', 1500)
                    } else {
                        alertError(response.data.responseMessage, false)
                    }
                })
                .catch(function (error) {
                    alertError(error, false)
                    console.error(error);
                });
        });
    }


    // Update Asuransi Action
    const updateAsuransiForm = document.getElementById('update-asuransi');
    if (updateAsuransiForm) {
        addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            const formData = new FormData(updateAsuransiForm);
            const id_asuransi = formData.get('id_asuransi');

            // Axios request
            axios.post('/asuransi/update/' + id_asuransi, formData)
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', '/asuransi', 1500)
                    } else {
                        alertError(response.data.responseMessage, false)
                    }
                })
                .catch(function (error) {
                    alertError(response.data.responseMessage, false)
                });
        });
    }

    // Update Keimigrasian Action
    const updateKeimigrasianForm = document.getElementById('update-keimigrasian');
    if (updateKeimigrasianForm) {
        addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            const formData = new FormData(updateKeimigrasianForm);
            const id_keimigrasian = formData.get('id_keimigrasian');

            // Axios request
            axios.post('/keimigrasian/update/' + id_keimigrasian, formData)
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', '/keimigrasian', 1500)
                    } else {
                        alertError(response.data.responseMessage, false)
                    }
                })
                .catch(function (error) {
                    alertError(response.data.responseMessage, false)
                });
        });
    }

    // Update Homestay Action
    const updateHomestayForm = document.getElementById('update-homestay');
    if (updateHomestayForm) {
        updateHomestayForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            const formData = new FormData(updateHomestayForm);
            const id_homestay = formData.get('id_homestay');

            // Append uploaded files to the main FormData object
            for (const [key, value] of uploadedFiles.entries()) {
                formData.append('files[]', value);
            }

            // Axios request
            axios.post('/homestay/update/' + id_homestay, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', '/homestay', 1500);
                    } else {
                        alertError(response.data.responseMessage, false);
                    }
                })
                .catch(function (error) {
                    alertError(error.response.data.responseMessage, false);
                });
        });
    }

    const updateDormitoryForm = document.getElementById('update-dormitory');
    if (updateDormitoryForm) {
        updateDormitoryForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            const formData = new FormData(updateDormitoryForm);
            const id_dormitory = formData.get('id_dormitory');

            // Append uploaded files to the main FormData object
            for (const [key, value] of uploadedFiles.entries()) {
                formData.append('files[]', value);
            }

            // Axios request
            axios.post('/dormitory/update/' + id_dormitory, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', '/dormitory', 1500);
                    } else {
                        alertError(response.data.responseMessage, false);
                    }
                })
                .catch(function (error) {
                    alertError(error.response.data.responseMessage, false);
                });
        });
    }

    const updateHotelForm = document.getElementById('update-hotel');
    if (updateHotelForm) {
        updateHotelForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            const formData = new FormData(updateHotelForm);
            const id_hotel = formData.get('id_hotel');

            // Append uploaded files to the main FormData object
            for (const [key, value] of uploadedFiles.entries()) {
                formData.append('files[]', value);
            }

            // Axios request
            axios.post('/hotel/update/' + id_hotel, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', '/hotel', 1500);
                    } else {
                        alertError(response.data.responseMessage, false);
                    }
                })
                .catch(function (error) {
                    alertError(error.response.data.responseMessage, false);
                });
        });
    }

    // Update Visa Action
    const updateVisaForm = document.getElementById('update-visa');
    if (updateVisaForm) {
        updateVisaForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            const formData = new FormData(updateVisaForm);
            const id_visa = formData.get('id_visa');

            // Append uploaded files to the main FormData object
            for (const [key, value] of uploadedFiles.entries()) {
                formData.append('files[]', value);
            }

            // Axios request
            axios.post('/visa/update/' + id_visa, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(function (response) {
                    if (response.data.responseCode == 200) {
                        alertTimeout(response.data.responseMessage, 'success', '/visa', 1500);
                    } else {
                        alertError(response.data.responseMessage, false);
                    }
                })
                .catch(function (error) {
                    alertError(error.response.data.responseMessage, false);
                });
        });
    }

    // Logic Preview Image
    const photoInput = document.getElementById('photoInput');
    if (photoInput) {
        photoInput.addEventListener('change', function (event) {
            const previewContainer = document.getElementById('preview-container');
            // const files = event.target.files;
            const files = Array.from(event.target.files);

            var totalPhoto = 0;
            // Check if files are selected
            if (files.length > 0) {
                // Clear previous previews if there are files
                previewContainer.innerHTML = '';

                // Create a new FormData object for uploaded files
                uploadedFiles = new FormData();

                for (const file of files) {
                    if (totalPhoto > 4) {
                        return;
                    }
                    uploadedFiles.append('files[]', file);

                    const reader = new FileReader();

                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;
                        img.classList.add('object-cover', 'max-h-24', 'max-w-30', 'w-full');
                        previewContainer.appendChild(img);
                    };

                    reader.readAsDataURL(file);
                    totalPhoto++;
                }
            }
        });
    }

    // Logic Nama File Upload
    const fileInput = document.getElementById('fileInput');
    if (fileInput) {
        fileInput.addEventListener('change', function (event) {
            // const previewContainer = document.getElementById('preview-container');
            const files = event.target.files;

            // Check if files are selected
            if (files.length > 0) {
                uploadedFiles = new FormData();

                for (const file of files) {
                    uploadedFiles.append('files[]', file);
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const fileLabel = document.getElementById('fileName');
                        fileLabel.innerText = file.name;
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    }

    // Logic Input Angka
    const inputFormHarga = document.querySelectorAll('.number-format');
    inputFormHarga.forEach(form => {
        form.addEventListener('input', function () {
            // Get the current input value
            let value = this.value;

            // Remove non-numeric characters
            value = value.replace(/[^0-9]/g, '');

            // Allow only one zero
            value = value.replace(/^0+(\d)/, '$1');

            // Add thousand separators
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Update the input value
            this.value = value;
        });
    });



    // Logic View Homestay
    const homestayView = document.querySelectorAll('.homestay');
    homestayView.forEach(dataHomestay => {
        dataHomestay.addEventListener('click', function () {
            // Get the current input value
            const value = this.getAttribute('value');
            window.location.href = "homestay/view/" + value;
            // window.location.href = "/view/" + value;
        });
    });

    //Logic View Dormitory
    const dormitoryView = document.querySelectorAll('.dormitory');
    dormitoryView.forEach(dataDormitory => {
        dataDormitory.addEventListener('click', function () {
            // Get the current input value
            const value = this.getAttribute('value');
            window.location.href = "dormitory/view/" + value;
            // window.location.href = "/view/" + value;
        });
    });

    const hotelView = document.querySelectorAll('.hotel');
    hotelView.forEach(dataHotel => {
        dataHotel.addEventListener('click', function () {
            // Get the current input value
            const value = this.getAttribute('value');
            window.location.href = "hotel/view/" + value;
            // window.location.href = "/view/" + value;
        });
    });



    // Logic View Keimigrasian
    const keimigrasianView = document.querySelectorAll('.keimigrasian');
    keimigrasianView.forEach(dataKeimigrasian => {
        dataKeimigrasian.addEventListener('click', function () {
            // Get the current input value
            const value = this.getAttribute('value');
            console.log(value)
            window.location.href = "keimigrasian/view/" + value;
        });
    });

    // File Upload Action
    const fileUploadContainer = document.getElementById('fileUploadContainer')
    if (fileUploadContainer) {
        fileUploadContainer.addEventListener('click', function () {
            document.getElementById('fileInput').click();
        });
    }

    // Print Rincian
    const printRincian = document.getElementById('print-rincian')
    if (printRincian) {
        printRincian.addEventListener('click', function () {
            window.print();
        });
    }

    // Logic Total Biaya Keimigrasian
    const totalBiayaInput = document.getElementById('totalBiaya');
    if (totalBiayaInput) {
        const biayaKeimigrasianInput = document.getElementById('biayaKeimigrasian');
        const biayaKemenakerInput = document.getElementById('biayaKemenaker');

        biayaKeimigrasianInput.addEventListener('input', updateTotalBiaya);
        biayaKemenakerInput.addEventListener('input', updateTotalBiaya);

        function updateTotalBiaya() {
            // Parse values as integers, remove thousand separators
            const biayaKeimigrasian = parseInt(biayaKeimigrasianInput.value.replace(/[^0-9]/g, ''), 10) || 0;
            const biayaKemenaker = parseInt(biayaKemenakerInput.value.replace(/[^0-9]/g, ''), 10) || 0;

            // Calculate the totalBiaya
            const totalBiaya = biayaKeimigrasian + biayaKemenaker;

            // Format the totalBiaya with thousand separators
            const formattedTotalBiaya = totalBiaya.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Update the value of the totalBiaya input with thousand separators
            totalBiayaInput.value = 'Rp. ' + formattedTotalBiaya;
            // totalBiayaInput.value = formattedTotalBiaya;
        }

    }
});

function showDate() {
    var date = new Date();

    var day = date.getDate();
    var month = new Intl.DateTimeFormat('ina', { month: 'long' }).format(date);
    var year = date.getFullYear();

    var dateString = day + ' ' + month + ' ' + year;

    document.getElementById('date').innerHTML = dateString;

    // Memanggil fungsi setiap detik (1000 milidetik) jika ingin memperbarui setiap detik
    // setTimeout(showDate, 1000);
}

// Memanggil fungsi pertama kali
showDate();

