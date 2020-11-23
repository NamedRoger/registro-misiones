class Region {
    constructor(){
        this.observers = [];
        this.regiones = [];
    }

    async getRegiones(){
        const res = await makeRequest('api/regiones/get.php');
        this.regiones = res;
    }

    subscribe(fn){
        this.observers.push(fn);
    }

    unSubscribe(fn){
        this.observers.splice(this.observers.indexOf(fn),1);
    }

    notifyObservers(){
        this.observers.forEach(o => {
            o.update();
        });
    }
}