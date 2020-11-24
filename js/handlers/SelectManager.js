class SelectManager {
    constructor(){
        this.observers = [];
    }

    subscribe(observer){
        this.observers.push(observer);
    }

    unSubscribe(observer){
        this.observers.splice(this.observers.indexOf(observer));
    }

    notify(model){
        this.observers.forEach(o => o.update(model));
    }
}
