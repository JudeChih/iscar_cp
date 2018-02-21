/**
 * Created by hesongshui on 2016/12/27.
 */

    var data=[];
    data.Price_sector=[];
    data.carsource=[];
    data.consumption='';
    data.carbody=[];
    data.passenger=[];
    data.cardoor=[];
    data.fueltype=[];
    data.transmission=[];
    data.displacement=[];
    data.equiptment=[];
    data.drivemode=[];
    data.caryear=[];
    if(sessionStorage.Price_sector) {
        data.Price_sector=JSON.parse(sessionStorage.Price_sector);
    }
    if(sessionStorage.caryear) {
        data.caryear=JSON.parse(sessionStorage.caryear);
    }
    if(sessionStorage.carsource){
        data.carsource=JSON.parse(sessionStorage.carsource);
    }
    if(sessionStorage.consumption){
        data.consumption=sessionStorage.consumption;
    }
    if(sessionStorage.carbody){
        data.carbody=JSON.parse(sessionStorage.carbody);
    }
    if(sessionStorage.passenger){
        data.passenger=JSON.parse(sessionStorage.passenger);
    }
    if(sessionStorage.cardoor){
        data.cardoor=JSON.parse(sessionStorage.cardoor);
    }
    if(sessionStorage.fueltype){
        data.fueltype=JSON.parse(sessionStorage.fueltype);
    }
    if(sessionStorage.transmission){
        data.transmission=JSON.parse(sessionStorage.transmission);
    }
    if(sessionStorage.displacement){
        data.displacement=JSON.parse(sessionStorage.displacement);
    }
    if(sessionStorage.equiptment){
        data.equiptment=JSON.parse(sessionStorage.equiptment);
    }
    if(sessionStorage.drivemode){
        data.drivemode=JSON.parse(sessionStorage.drivemode);
    }
    if(sessionStorage.car_model){
        data.car_model=(sessionStorage.car_model);
    }
    if(sessionStorage.brand){
        data.brand=(sessionStorage.brand);
    }
    if(sessionStorage.key_content){
        data.key_content=(sessionStorage.key_content);
    }

