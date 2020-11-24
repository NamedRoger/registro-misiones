class ChurchSelect {
    constructor(element){
        this.element = document.querySelector(element);
    }

    async onLoadChurchs(seccionId){
        if(this.element instanceof HTMLSelectElement){
            if(this.element.options.length > 0) this.element.innerHTML ="";
            const churchs = await makeRequest(`api/iglesias/getBySeccion.php?seccion_id=${seccionId}`);
            let op;
            churchs.forEach(church => {
                op = document.createElement("option");
                op.value = church.id;
                op.innerText = church.name +" - "+ church.type_church;
                this.element.options.add(op);
            });
        }
    }

    update(model){
        this.onLoadChurchs(model);
    }
}
