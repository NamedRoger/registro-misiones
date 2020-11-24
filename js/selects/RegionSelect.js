class RegionSelect {
    constructor(element){
        this.events = new SelectManager();
        this.element = document.querySelector(element);
        this.element.addEventListener("change",e => this.onChange(e));
    }

    async onLoadRegions(){
        if(this.element instanceof HTMLSelectElement){
            const regiones = await makeRequest('api/regiones/get.php');
            let op;
            regiones.forEach(region => {
                op = document.createElement("option");
                op.value = region.id;
                op.innerText = region.name;
                this.element.options.add(op);
            });
            if(this.element.options[0].value) this.events.notify(this.element.options[0].value);
        }
    }

    onChange(event){
        if(event instanceof Event){
            const regionId = event.target.value;
            this.events.notify(regionId);
        }
    }
}