<?= $this->extend('Layout/admin') ?>

<?= $this->section('content') ?>
<div id="admin-content">
    <div class="card">
        <form>
            <div class="card-header d-flex bd-highlight">

                <h2 class="p-2">{{ page_title }}</h2>

                <nav class="p-2 flex-grow-1" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" v-for="(item, index) in breadcrumbs" :key="index">
                            <a :href="item.link">
                                {{ item.title }}
                            </a>
                        </li>
                    </ol>
                </nav>

                <div class="p-2">
                    <button type="button" class="btn btn-primary btn-lg" @click="onSubmit()">
                        <i class="fas fa-save"></i>
                    </button>
                </div>

            </div>
            <div class="card-body">
                <fieldset>
                    <legend><?= lang('BaseSetting.base_setting') ?></legend>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            <?= lang('BaseSetting.site_name') ?> 
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            <div class="input-group" v-for="(item, index) in langs" :key="index">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ item.lang_name }}</span>
                                </div>
                                <input type="text" class="form-control" v-model="form.site_name[item.lang_code]">
                            </div>
                            <p class="text-danger" v-for="(error, index) in errors.site_name">
                                {{ error.error_msg }}
                            </p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="keyword" class="col-sm-2 col-form-label"><?= lang('BaseSetting.keyword') ?></label>
                        <div class="col-sm-10">
                            <input type="text" id="keyword" class="form-control" v-model="form.keyword">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label"><?= lang('BaseSetting.description') ?></label>
                        <div class="col-sm-10">
                            <textarea :row="5" class="form-control" id="description" v-model="form.description"></textarea>
                        </div>
                    </div>

                </fieldset>
                <fieldset>
                    <legend><?= lang('BaseSetting.lang_setting') ?></legend>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <th><?= lang('BaseSetting.lang_code') ?></th>
                            <th><?= lang('BaseSetting.lang_name') ?></th>
                            <th><?= lang('Comm.action') ?></th>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in form.lang" :key="index">
                                <td>
                                    <input type="text" class="form-control" v-model="item.lang_code" disabled>
                                </td>
                                <td>
                                    <input type="text" class="form-control" v-model="item.lang_name">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" @click="delLang(index)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr />
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" v-model="newLangCode">
                                </td>
                                <td>
                                    <input type="text" class="form-control" v-model="newLangName">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success" @click="addLang()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </form>
    </div>
</div>

<?= $this->endsection() ?>

<?= $this->section('js') ?>
<script>
    Vue.use(window.vuelidate.default)
    var validationMixin = window.vuelidate.validationMixin
    new Vue({
        el: '#admin-content',
        data: {
            page_title: '<?= $page_title ?>',
            breadcrumbs: <?= json_encode($breadcrumbs) ?>,
            langs: <?= json_encode($langs) ?>,
            form: <?= json_encode($data) ?>,
            newLangCode: '',
            newLangName: '',
            errors: {
                site_name: []
            }
        },
        watch: {
            form: function(value) {
                this.checkSiteName()
            }
        },
        methods: {
            addLang() {
                for (var item of this.form.lang) {
                    if (item.lang_code == this.newLangCode) {
                        Swal.fire({
                            icon: 'error',
                            title: '<?= lang('Comm.noties') ?>',
                        })
                        return false
                    }
                }
                this.form.lang.push({
                    lang_code: this.newLangCode,
                    lang_name: this.newLangName
                })
                this.newLangCode = ''
                this.newLangName = ''
            },
            delLang(index) {
                this.form.lang.splice(index, 1)
            },
            checkSiteName() {
                this.errors.site_name = []
                var hasError = false
                for (var item of this.langs) {
                    if (this.form.site_name[item.lang_code] == '') {
                        this.errors.site_name.push({
                            error_msg: `<?= lang('BaseSetting.site_name') ?> (${item.lang_name}) 為必填`
                        })
                        hasError = true
                    }
                }
                
                return (hasError) ? false : true 
            },
            validatior () {
                var isValid = true

                if (this.checkSiteName() === false) {
                    isValid = false
                }
                
                return isValid
            },
            onSubmit() {
                if (this.validatior()) {
                    $.ajax({
                        url: '<?= site_url('admin/system/setting') ?>',
                        type: 'put',
                        dataType: 'json',
                        data: JSON.stringify(this.form),
                        contentType: "application/json;charset=utf-8",
                        success: function (res) {
                            Swal.fire({
                                icon: 'success',
                                title: '<?= lang('Comm.noties') ?>',
                                text: res.msg 
                            })
                        },
                        error: function (res) {
                            Swal.fire({
                                icon: 'error',
                                title: '<?= lang('Comm.noties') ?>',
                                text: res.error_msg
                            })
                        }
                    })
                }
            }
        }
    })
</script>

<?= $this->endsection() ?>