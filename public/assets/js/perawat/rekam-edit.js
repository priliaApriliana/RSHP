// public/js/perawat/rekam-edit.js
$(document).ready(function () {

    // baca jumlah awal dari data-attribute
    const tindakanDataEl = document.getElementById('tindakan-data');
    let tindakanCount = 1;
    if (tindakanDataEl) {
        const v = parseInt(tindakanDataEl.dataset.count, 10);
        if (!isNaN(v)) tindakanCount = v;
    }

    // ambil option HTML dari template
    let tindakanOptions = '';
    const tpl = document.getElementById('tindakan-options-template');
    if (tpl) {
        tindakanOptions = tpl.innerHTML.trim();
    }

    $('#add-tindakan').click(function () {
        tindakanCount++;

        const newTindakan = `
            <div class="tindakan-item mb-3">
                <div class="row">

                    <div class="col-md-6">
                        <select name="tindakan[]" class="form-control" required>
                            <option value="">-- Pilih Tindakan --</option>
                            ${tindakanOptions}
                        </select>
                    </div>

                    <div class="col-md-5">
                        <input type="text" name="detail[]" class="form-control"
                               placeholder="Detail/Catatan (opsional)">
                    </div>

                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm remove-tindakan">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                </div>
            </div>
        `;

        $('#tindakan-container').append(newTindakan);
        updateRemoveButtons();
    });

    $(document).on('click', '.remove-tindakan', function () {
        $(this).closest('.tindakan-item').remove();
        tindakanCount--;
        updateRemoveButtons();
    });

    function updateRemoveButtons() {
        if (tindakanCount > 1) {
            $('.remove-tindakan').show();
        } else {
            $('.remove-tindakan').hide();
        }
    }

    // set initial state
    updateRemoveButtons();
});
