class Control {
    constructor(type = null) {
        this.type = type;
        this.table = $("#kt_table_data");
        this.selectedCheckboxValues = []; // Inisialisasi array untuk menyimpan nilai checkbox yang terpilih
        this.firstSearch = true;
    }

    async searchAllData(data) {

        try {
            const dataUpdate = [];
            const response = await $.ajax({
                url: '/data-kemiskinan/get-all', // Ganti dengan URL endpoint pencarian data
                method: 'GET',
            });

            if (response.success) {
                const newData = response.data; // Data yang ditemukan dari server

                if (data && data.length > 0) { // Periksa apakah ada data yang dipilih
                    newData.forEach(item => {
                        let meetAllCriteria = true; // Inisialisasi sebagai true, bila item memenuhi semua kriteria.

                        $.each(data, function (index, value) {
                            // Periksa apakah item tidak memenuhi salah satu kriteria
                            if (
                                (
                                    (value === 'Milik Sendiri' || value === 'Bebas Sewa' || value === 'Kontrak/Sewa' || value === 'Menumpang' || value === 'Pinjam Pakai') &&
                                    !(item.kepemilikan === value)
                                ) ||
                                (
                                    (value === 'Beton' || value === 'Genteng' || value === 'Asbes/Seng' || value === 'Kayu/Sirap' || value === 'Bambu' || value === 'Jerami/Ijuk/Rumbia/Daun-daunan') &&
                                    !(item.jenis_atap === value)
                                ) ||
                                (
                                    (value === 'Tembok' || value === 'Seng' || value === 'Kayu/Papan' || value === 'Bambu') &&
                                    !(item.jenis_dinding === value)
                                ) ||
                                (
                                    (value === 'Keramik/Granit/Marmer/Ubin/Tegel/Teraso' || value === 'Semen' || value === 'Kayu/Papan' || value === 'Bambu' || value === 'Tanah') &&
                                    !(item.jenis_lantai === value)
                                ) ||
                                (
                                    (value === 'Listrik Pribadi >s/d 900 Watt' || value === 'Listrik Pribadi s/d 900 Watt' || value === 'Listrik Pribadi s/d 450 Watt' || value === 'Genset/solar cell' || value === 'Listrik Bersama' || value === 'Menumpang' || value === 'Non-Listrik') &&
                                    !(item.sumber_penerangan === value)
                                ) ||
                                (
                                    (value === 'Listrik/Gas' || value === 'Gas/Kayu Bakar' || value === 'Minyak Tanah' || value === 'Kayu Bakar' || value === 'Arang/Kayu') &&
                                    !(item.bahan_bakar_masak === value)
                                ) ||
                                (
                                    (value === 'Air Kemasan/Isi Ulang' || value === 'Sumur Bor' || value === 'Air PDAM' || value === 'Sumur Terlindung' || value === 'Sumur Tidak Terlindung' || value === 'Air Permukaan (Sungai, Danau, dll)' || value === 'Air Hujan') &&
                                    !(item.sumber_air === value)
                                ) ||
                                (
                                    (value === 'Ya, dengan Septic Tank' || value === 'Tidak, Jamban Umum/Bersama' || value === 'Menumpang' || value === 'Ya, tanpa Septic Tank') &&
                                    !(item.fasilitas_bab === value)
                                )
                            ) {
                                meetAllCriteria = false;
                                return false; // Keluar dari loop karena sudah tidak memenuhi kriteria
                            }
                        });

                        // Jika item memenuhi semua kriteria, tambahkan ke dataUpdate
                        if (meetAllCriteria) {
                            dataUpdate.push(item);
                        }
                    });

                    // newData.forEach(item => {
                    // for (const key in item) {
                    //   if (data.includes(item[key])) {
                    //     dataUpdate.push(item);
                    //     break;
                    //   }
                    // }
                    // });
                } else {
                    // Jika data kosong, tampilkan data semula
                    dataUpdate.push(...newData);
                }

                // Lakukan pencarian menggunakan dataUpdate
                this.table.DataTable().clear().rows.add(dataUpdate).draw();
            }
        } catch (error) {
            console.error('Error searching data:', error);
        }
    }

    searchTable(data) {
        if (data.trim() === "") {
            // Jika input pencarian kosong, tampilkan seluruh data (tanpa filter)
            this.table.DataTable().search("").draw();
        }
    }

    overlay_form(type, module, url = null, role = null) {
        $(".title_side_form").html(`${type} ${module}`);
        $(".text-danger").html("");
        if (type == "Tambah") {
            $(".form-data")[0].reset();
            $("#from_select").val(null).trigger("change");
            $(".form-select").val(null).trigger("change");
            $(".form-data").attr("data-type", "add");
        } else {
            $(".form-data").attr("data-type", "update");
            $.ajax({
                url: url,
                method: "GET",
                success: function (res) {
                    if (res.success == true) {
                        $.each(res.data, function (x, y) {
                            const $selectField = $("select[name='" + x + "[]']");

                            if ($selectField.attr("multiple")) {
                                // Jika elemen adalah select dengan multiple selection
                                const values = JSON.parse(y); // Pisahkan nilai-nilai berdasarkan koma
                                $selectField.val(values).trigger('change'); // Atur nilai-nilai yang dipilih
                            } else {
                                // Untuk elemen select biasa, input biasa, dan textarea
                                $selectField.val(y).trigger('change');
                            }

                            if ($("input[name='" + x + "']").is(":radio")) {
                                $("input[name='" + x + "'][value='" + y + "']").prop(
                                    "checked",
                                    true
                                );
                            } else if ($("input[name='" + x + "']").attr("type") === "file") {
                                // Jika input adalah tipe file
                                // Tambahkan logika di sini untuk menangani input file
                                // Misalnya, menampilkan nama file atau melakukan pengolahan tambahan
                                const fileName = y; // Nama file yang diunggah
                                const fileInfoContainer = $("#fileInfoContainer"); // Ganti dengan ID atau kelas sesuai kebutuhan
                                fileInfoContainer.html(
                                    `<a href="/storage/file/${fileName}" target="_blank" class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger p-2 py-1">
                                        <div class="d-flex justify-content-center align-items-center" style="gap: 5px; color: red;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                                            </svg>
                                            Lihat File
                                        </div>
                                    </a>`
                                );

                                const logoInfoContainer = $('#logoInfoContainer');
                                logoInfoContainer.html(`<img src="/storage/logo/${fileName}" style="max-width:100%;">`);

                            } else {
                                $("input[name='" + x + "']").val(y);
                                $("select[name='" + x + "']").val(y);
                                $("textarea[name='" + x + "']").val(y);
                                $("select[name='" + x + "']").trigger("change");
                            }

                        });
                    }

                },
                error: function (xhr) {
                    alert("gagal");
                },
            });
        }
        // this._offcanvasObject.show();
    }

    submitFormMultipart(url, role_data = null, module = null, method) {
        let this_ = this;
        let table_ = this.table;

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: method,
            url: url,
            data: $(".form-data").serialize(),
            success: function (response) {
                $(".text-danger").html("");
                if (response.success == true) {
                    swal
                        .fire({
                            text: `${module} berhasil di ${role_data}`,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        })
                        .then(function () {
                            $("#side_form_close").trigger("click");
                            $('#kt_modal_1').modal('hide');
                            table_.DataTable().ajax.reload();
                            $("form")[0].reset();
                            $("#from_select").val(null).trigger("change");
                            $(".form-select").val(null).trigger("change");
                        });
                } else {
                    $("form")[0].reset();
                    $("#from_select").val(null).trigger("change");
                    $(".form-select").val(null).trigger("change");
                    swal.fire({
                        title: response.message,
                        text: response.data,
                        icon: "warning",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            },
            error: function (xhr) {
                $(".text-danger").html("");
                $.each(xhr.responseJSON["errors"], function (key, value) {
                    $(`.${key}_error`).html(value);
                });
            },
        });
    }

    submitFormMultipartDataEvaluasi(url, role_data = null, module = null, method, formData) {
        let this_ = this;
        let table_ = this.table;

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: method,
            url: url,
            data: formData,
            success: function (response) {
                $(".text-danger").html("");
                if (response.success == true) {
                    swal
                        .fire({
                            text: `${module} berhasil di ${role_data}`,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        })
                        .then(function () {
                            $("#side_form_close").trigger("click");
                            table_.DataTable().ajax.reload();
                            $("form")[0].reset();
                            $("#from_select").val(null).trigger("change");
                            $(".form-select").val(null).trigger("change");
                        });
                } else {
                    $("form")[0].reset();
                    $("#from_select").val(null).trigger("change");
                    $(".form-select").val(null).trigger("change");
                    swal.fire({
                        title: response.message,
                        text: response.data,
                        icon: "warning",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            },
            error: function (xhr) {
                $(".text-danger").html("");
                $.each(xhr.responseJSON["errors"], function (key, value) {
                    $(`.${key}_error`).html(value);
                });
            },
        });
    }

    submitForm(url, role_data = null, module = null, method, formData, route) {
        let this_ = this;
        let table_ = this.table;

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: method,
            url: url,
            data: formData,
            success: function (response) {
                console.log(response);
                $(".text-danger").html("");
                if (response.success) {
                    swal.fire({
                        text: `${module} berhasil di ${role_data}`,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(function () {
                        table_.DataTable().ajax.reload();
                        window.location.href = route;
                    });
                } else {
                    $("form")[0].reset();
                    $("#from_select").val(null).trigger("change");
                    $(".form-select").val(null).trigger("change");
                    swal.fire({
                        title: response.message || "Terjadi kesalahan",
                        text: response.data || "Mohon coba lagi",
                        icon: "warning",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            },
            error: function (xhr) {
                $(".text-danger").html("");
                $.each(xhr.responseJSON["errors"], function (key, value) {
                    $(`.${key}_error`).html(value);
                });
            },
        });
    }


    submitFormMultipartData(url, role_data = null, module = null, method) {
        console.log(url);
        let this_ = this;
        let table_ = this.table;

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: method,
            url: url,
            data: new FormData($(".form-data")[0]),
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                $(".text-danger").html("");
                if (response.success == true) {
                    swal
                        .fire({
                            text: `${module} berhasil di ${role_data}`,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        })
                        .then(function () {
                            $("#side_form_close").trigger("click");
                            table_.DataTable().ajax.reload();
                            $("form")[0].reset();
                            $("#from_select").val(null).trigger("change");
                            $(".form-select").val(null).trigger("change");
                        });
                } else {
                    $("form")[0].reset();
                    $("#from_select").val(null).trigger("change");
                    $(".form-select").val(null).trigger("change");
                    swal.fire({
                        title: response.message,
                        text: response.data,
                        icon: "warning",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            },
            error: function (xhr) {
                $(".text-danger").html("");
                $.each(xhr.responseJSON["errors"], function (key, value) {
                    $(`.${key}_error`).html(value);
                });
            },
        });
    }

    ajaxDelete(url, label) {
        let token = $("meta[name='csrf-token']").attr("content");
        let table_ = this.table;
        Swal.fire({
            title: `Apakah anda yakin akan menghapus data ${label} ?`,
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus itu!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "DELETE",
                    data: {
                        id: $(this).attr("data-id"),
                        _token: token,
                    },
                    success: function () {
                        swal
                            .fire({
                                title: "Menghapus!",
                                text: "Data Anda telah dihapus.",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            })
                        table_.DataTable().ajax.reload();
                    },
                });
            }
        });
    }

    push_select(url, element, type) {
        let data_nama;
        // Lakukan permintaan AJAX untuk mendapatkan data_nama
        $.ajax({
            url: '/admin/get-alternatif',
            method: "GET",
            success: function (res) {
                // Ambil nama_mahasiswa dari setiap item dalam res.data
                data_nama = res.data.map(item => item.nama_mahasiswa);
            },
            error: function (xhr) {
                alert("gagal");
            },
        });
        // Lakukan permintaan AJAX untuk mendapatkan data terkait
        $.ajax({
            url: url,
            method: "GET",
            success: function (res) {
                $(element).html("");
                let html = "<option></option>";

                // Filter data yang sudah ada dari data baru
                let filteredData = res.data.filter(item => !data_nama.includes(item.nama_mahasiswa));

                let selectedData = (type === 'Tambah') ? filteredData : res.data;

                // Loop melalui data yang sudah dipilih
                selectedData.forEach(item => {
                    let nama_mahasiswa = item.nama_mahasiswa;
                    html += `<option value="${nama_mahasiswa}">${nama_mahasiswa}</option>`;
                });

                $(element).html(html);
            },
            error: function (xhr) {
                alert("gagal");
            },
        });
    }

    push_select_surat1(url, element) {
        // Lakukan permintaan AJAX untuk mendapatkan data_nama
        $.ajax({
            url: '/admin/get-surat',
            method: "GET",
            success: function (res) {
                // Ambil nama_mahasiswa dari setiap item dalam res.data
                let data_nama = res.data.map(item => item.nama_mahasiswa);

                // Lakukan permintaan AJAX untuk mendapatkan data terkait
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function (res) {
                        $(element).html("");
                        let html = "<option></option>";

                        // Filter data yang sudah ada dari data baru
                        let filteredData = res.data.filter(item => !data_nama.includes(item.nama_mahasiswa));

                        // Loop melalui data yang sudah dipilih
                        filteredData.forEach(item => {
                            let nama_mahasiswa = item.nama_mahasiswa;
                            html += `<option value="${nama_mahasiswa}">${nama_mahasiswa}</option>`;
                        });

                        $(element).html(html);
                    },
                    error: function (xhr) {
                        alert("Gagal mengambil data terkait");
                    },
                });
            },
            error: function (xhr) {
                alert("Gagal mengambil data_nama");
            },
        });
    }


    push_select_surat2(url, element) {
        // Lakukan permintaan AJAX untuk mendapatkan data terkait
        $.ajax({
            url: url,
            method: "GET",
            success: function (res) {
                $(element).html("");
                let html = "<option></option>";
                // Loop melalui data yang sudah dipilih
                res.data.forEach(item => {
                    html += `<option value="${item.uuid}">${item.nama_dosen}</option>`;
                });

                $(element).html(html);
            },
            error: function (xhr) {
                alert("gagal");
            },
        });
    }

    push_select_mitra(url, element) {
        // Lakukan permintaan AJAX untuk mendapatkan data terkait
        $.ajax({
            url: url,
            method: "GET",
            success: function (res) {
                $(element).empty(); // Menghapus konten sebelumnya
                let uniqueUUIDs = new Set(); // Menggunakan Set untuk menghindari duplikat

                // Loop melalui data yang sudah dipilih
                res.data.forEach(item => {
                    if (Array.isArray(item.uuid_mitra)) {
                        item.uuid_mitra.forEach(y => {
                            uniqueUUIDs.add(y); // Menambahkan UUID ke Set
                        });
                    }
                });

                // Membuat HTML option
                let html = "<option></option>";
                uniqueUUIDs.forEach(uuid => {
                    html += `<option value="${uuid}">${uuid}</option>`;
                });

                $(element).html(html); // Update elemen select dengan HTML yang baru
            },
            error: function (xhr) {
                alert("Gagal mengambil data: " + xhr.statusText); // Menampilkan pesan kesalahan
            },
        });
    }


    push_select2(url, element) {
        $.ajax({
            url: url,
            method: "GET",
            success: function (res) {
                $(element).html("");
                let html = "<option selected disabled>Pilih</option>";
                $.each(res.data, function (x, y) {
                    html += `<option value="${y.id}">${y.text}</option>`;
                });
                $(element).html(html);
            },
            error: function (xhr) {
                alert("gagal");
            },
        });
    }

    push_select3(data, element) {
        $(element).html("");
        let html = "<option></option>";
        $.each(data, function (x, y) {
            html += `<option value="${y.text}">${y.text}</option>`;
        });
        $(element).html(html);
    }

    push_select4(data, element) {
        $(element).html("");
        let html = "<option></option>";
        $.each(data, function (x, y) {
            const nilaiMapping = {
                'Sangat Baik': '5',
                'Baik': '4',
                'Cukup': '3',
                'Kurang': '2',
                'Sangat Kurang': '1',
            };

            html += `<option value="${nilaiMapping[y.text] || ''}">${y.text}</option>`;
        });
        $(element).html(html);
    }

    dropdownCheckbox(data, element) {
        const this_ = this; // Simpan referensi objek 'this' di dalam variabel
        if (!this.selectedCheckboxValues.length && data && data.length > 0) {
            let html = "";
            $.each(data, function (x, y) {
                html += `
          <li class="mb-3 mt-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="${y.text}" id="flexCheckDefault${y.text}"/>
              <label class="form-check-label" for="flexCheckDefault${y.text}">
                ${y.text}
              </label>
            </div>
          </li>
        `;
            });
            $(element).html(html);

            // Tambahkan event listener untuk setiap checkbox
            $(element).find('.form-check-input').on('change', function () {
                const selectedValue = $(this).val();
                if (this.checked) {
                    // Jika checkbox dicentang, tambahkan nilai ke dalam array
                    this_.selectedCheckboxValues.push(selectedValue);
                } else {
                    // Jika checkbox tidak dicentang, hapus nilai dari array
                    const index = this_.selectedCheckboxValues.indexOf(selectedValue);
                    if (index !== -1) {
                        this_.selectedCheckboxValues.splice(index, 1);
                    }
                }

                // Panggil fungsi untuk meng-update tabel sesuai dengan nilai checkbox yang dipilih
                this_.updateTableBasedOnFilters();
            });
        }
    }

    updateTableBasedOnFilters() {
        if (this.selectedCheckboxValues.length > 0) {
            const selectedFilters = this.selectedCheckboxValues.join(',');
            // Panggil fungsi untuk meng-update tabel berdasarkan nilai checkbox yang dipilih
            this.searchAllData(this.selectedCheckboxValues);
            this.firstSearch = false; // Setel firstSearch ke false setelah pencarian pertama kali
        } else {
            // Jika tidak ada checkbox yang dicentang, tampilkan data semula
            if (!this.firstSearch) { // Tampilkan data semula hanya jika bukan pencarian pertama kali
                this.searchAllData(null);
            }
        }
    }

    push_radio(data, radio, element) {
        $(element).empty();
        let html = "";
        $.each(data, function (x, y) {
            html += `<label class="form-label radio-button"><input type="radio" name="${radio}" value="${y.text}">${y.text}</label>`;
        });
        $(element).html(html);
    }

    async initDatatable(url, columns, columnDefs) {
        this.table.DataTable().clear().destroy();

        // await this.table.dataTable().clear().draw();
        await this.table.dataTable().fnClearTable();
        await this.table.dataTable().fnDraw();
        await this.table.dataTable().fnDestroy();
        this.table.DataTable({
            responsive: true,
            pageLength: 10,
            order: [[0, "asc"]],
            processing: true,
            ajax: url,
            columns: columns,
            columnDefs: columnDefs,
            rowCallback: function (row, data, index) {
                var api = this.api();
                var startIndex = api.context[0]._iDisplayStart;
                var rowIndex = startIndex + index + 1;
                $('td', row).eq(0).html(rowIndex);
            },
        });
    }
}
