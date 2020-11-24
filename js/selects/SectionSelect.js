class SectionSelect {
    constructor(element){
        this.events = new SelectManager();
        this.element = document.querySelector(element);
        this.element.addEventListener("change",e => this.onChange(e));
    }

    async onLoadSections(regionId){
        if(this.element instanceof HTMLSelectElement){
            if(this.element.options.length > 0) this.element.innerHTML ="";
            const sections = await makeRequest(`api/secciones/getByRegion.php?region_id=${regionId}`);
            let op;
            sections.forEach(section => {
                op = document.createElement("option");
                op.value = section.id;
                op.innerText = section.name;
                this.element.options.add(op);
            });
            if(this.element.options[0].value) this.events.notify(this.element.options[0].value);
        }
    }

    onChange(event){
        if(event instanceof Event){
            const sectionId = event.target.value;
            this.events.notify(sectionId);
        }
    }

    update(model){
        this.onLoadSections(model);
    }
}