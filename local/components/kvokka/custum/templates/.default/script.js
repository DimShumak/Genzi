class CustumComponent {
    constructor(params, signedParamsString) {
        this.signedParamsString = signedParamsString;
        this.params = params;

        console.log(params, signedParamsString);
    }

    init() {
        this.registerEvents();

        this.addAction(1);
        this.saveAction({ test: 123 });
    }

    registerEvents() {
        // const $root = BX(this.params['ROOT_ID']);

        // if (!$root) return;

        // BX.ready(() => {
        //     BX.bindDelegate(
        //         $root, 'click', { className: 'btn' },
        //         function (e) {
        //             //тут обработчик

        //             alert("Hello")

        //             return BX.PreventDefault(e);
        //         }
        //     );
        // })

        const $root = $(`#${this.params['ROOT_ID']}`);

        if (!$root.length) return;

        $(() => {
            $root.on('click', '.btn', function (e) {
                e.preventDefault();

                //тут обработчик

                alert("Hello")
            });
        });
    }

    async addAction(id) {
        const result = await this.runAjax("add", { id });

        try {
            console.log(result);
        } catch (err) {
            console.log(err);
        }
    }

    async saveAction(data) {
        const result = await this.runAjax("save", data, true);

        try {
            console.log(result);
        } catch (err) {
            console.log(err);
        }
    }

    async runAjax(action, data, isJson = false) {
        const payload = {
            mode: "class",
            signedParameters: this.signedParamsString,
        };

        if (isJson) {
            payload.json = data
        } else {
            payload.data = data
        }

        return BX.ajax.runComponentAction("kvokka:custum", action, payload);
    }
}
