/**
 * Created by hesongshui on 2016/12/27.
 */
var search_adv= new Vue({
    el:'#search_adv',
    data: {
        data:data,
        content:localStorage.content?JSON.parse(localStorage.content):'',
        language:language.search_adv
    },
//                清除筛选条件
    methods: {
        Price_sectors:function (e) {
            var Price_sector_val=data.Price_sector[e];
            if(Price_sector_val=='-5'||Price_sector_val=='100-'||Price_sector_val=='-80'||Price_sector_val=='200-'||Price_sector_val=='200+'){
                $('.clearfix li').each(function (k,v) {
                    if($(this).html().indexOf(Price_sector_val.replace("-",""))>0){
                        $(this).removeClass('c_color_selced')
                    }
                    if(Price_sector_val=='200+'&&$(this).html().indexOf('未公佈價格')>0){
                        $(this).removeClass('c_color_selced')
                    }
                });
            }else {
                $('.clearfix li').each(function (k,v) {
                    if($(this).html().indexOf(Price_sector_val)>0){
                        $(this).removeClass('c_color_selced')
                    }
                });
            }
            data.Price_sector.splice(e,1);
            sessionStorage.Price_sector=JSON.stringify(data.Price_sector);
            search_adv.$set('data.Price_sector',data.Price_sector);
        },
        consumptions:function (e) {
            $('.clearfix li').each(function (k,v) {
                if($(this).html().indexOf(data.consumption)>0){
                    $(this).removeClass('c_color_selced')
                }
            });
            sessionStorage.consumption='';
            data.consumption='';
            search_adv.$set('data.consumption',data.consumption);
        },
        carsources:function (e) {
            var carsource_value='';
            $(search_adv.content.carsource).each(function (k,v) {
                if (data.carsource[e]==v.carsource_id){
                    carsource_value=v.value;
                }
            });
            $('.clearfix li').each(function (k,v) {
                if($(this).html().indexOf(carsource_value)>0){
                    $(this).removeClass('c_color_selced')
                }
            });
            data.carsource.splice(e,1);
            sessionStorage.carsource=JSON.stringify(data.carsource);
            search_adv.$set('data.carsource',data.carsource);
        },
        caryear:function (e) {
            var caryear_value='';
            console.log(e)
            console.log(search_adv.content.caryear)
            console.log(data.caryear[e])
            $(search_adv.content.caryear).each(function (k,v) {
                if (data.caryear[e]==v.ci_car_year_style){
                  caryear_value=v.ci_car_year_style;
                }
            });
            console.log(caryear_value)
            $('.clearfix li').each(function (k,v) {
                if($(this).html().indexOf(caryear_value)>0){
                    $(this).removeClass('c_color_selced')
                }
            });
            data.caryear.splice(e,1);
            sessionStorage.caryear=JSON.stringify(data.caryear);
            search_adv.$set('data.caryear',data.caryear);
        },
        carbodys:function (e) {
            var carbody_value='';
            $(search_adv.content.carbody).each(function (k,v) {
                if (data.carbody[e]==v.cbt_id){
                    carbody_value=v.fullname;
                }
            });
            $('.clearfix li').each(function (k,v) {
                if($(this).html().indexOf(carbody_value)>0){
                    $(this).removeClass('c_color_selced')
                }
            });
            data.carbody.splice(e,1);
            sessionStorage.carbody=JSON.stringify(data.carbody);
            search_adv.$set('data.carbody',data.carbody);
        },
        passengers:function (e) {
            var cpassenger_value='';
            $('.clearfix li').each(function (k,v) {
                if($(this).html().indexOf(data.passenger[e])>0){
                    $(this).removeClass('c_color_selced')
                }
            });
            data.passenger.splice(e,1);
            sessionStorage.passenger=JSON.stringify(data.passenger);
            search_adv.$set('data.passenger',data.passenger);
        },
        cardoors:function (e) {
            $('.clearfix li').each(function (k,v) {
                if($(this).html().indexOf(data.cardoor[e])>0){
                    $(this).removeClass('c_color_selced')
                }
            });
            data.cardoor.splice(e,1);
            sessionStorage.cardoor=JSON.stringify(data.cardoor);
            search_adv.$set('data.cardoor',data.cardoor);
        } ,
        fueltypes:function (e) {
            var fueltypes_value='';
            $(search_adv.content.fueltype).each(function (k,v) {
                if (data.fueltype[e]==v.fueltype){
                    fueltypes_value=v.value;
                }
            });
            $('.clearfix li').each(function (k,v) {
                if($(this).html().indexOf(fueltypes_value)>0){
                    $(this).removeClass('c_color_selced')
                }
            });
            data.fueltype.splice(e,1);
            sessionStorage.fueltype=JSON.stringify(data.fueltype);
            search_adv.$set('data.fueltype',data.fueltype);
        },
        transmissions:function (e) {
            var transmission_value='';
            $(search_adv.content.transmission).each(function (k,v) {
                if (data.transmission[e]==v.transmission_id){
                    transmission_value=v.value;
                }
            });
            $('.clearfix li').each(function (k,v) {
                if($(this).html().indexOf(transmission_value)>0){
                    $(this).removeClass('c_color_selced')
                }
            });
            data.transmission.splice(e,1);
            sessionStorage.transmission=JSON.stringify(data.transmission);
            search_adv.$set('data.transmission',data.transmission);
        },
        displacements:function (e) {
            $('.clearfix li').each(function (k,v) {
                if($(this).html().indexOf(data.displacement[e])>0){
                    $(this).removeClass('c_color_selced')
                }
            });
            data.displacement.splice(e,1);
            sessionStorage.displacement=JSON.stringify(data.displacement);
            search_adv.$set('data.displacement',data.displacement);
        },
        equiptments:function (e) {
            $('.clearfix li').each(function (k,v) {
                if($(this).html().indexOf(data.equiptment[e])>0){
                    $(this).removeClass('c_color_selced')
                }
            });
            data.equiptment.splice(e,1);
            sessionStorage.equiptment=JSON.stringify(data.equiptment);
            search_adv.$set('data.equiptment',data.equiptment);
        },
        drivemodes:function (e) {
            var drivemode_value='';
            $(search_adv.content.drivemode).each(function (k,v) {
                if (data.drivemode[e]==v.drivemode_id){
                    drivemode_value=v.value;
                }
            });
            $('.clearfix li').each(function (k,v) {
                if($(this).html().indexOf(drivemode_value)>0){
                    $(this).removeClass('c_color_selced')
                }
            });
            data.drivemode.splice(e,1);
            sessionStorage.drivemode=JSON.stringify(data.drivemode);
            search_adv.$set('data.drivemode',data.drivemode);
        },
        click_carsource:function (e) {
            if(data.carsource.indexOf(+e)==-1){
                data.carsource.push(+e);
                sessionStorage.carsource=JSON.stringify(data.carsource);
                search_adv.$set('data.carsource',data.carsource)
            }else {
                data.carsource.splice(data.carsource.indexOf(+e),1);
                sessionStorage.carsource=JSON.stringify(data.carsource);
                search_adv.$set('data.carsource',data.carsource)
            }
        },
        click_caryear:function (e) {
            if(data.caryear.indexOf(+e)==-1){
                data.caryear.push(+e);
                sessionStorage.caryear=JSON.stringify(data.caryear);
                search_adv.$set('data.caryear',data.caryear)
            }else {
                data.caryear.splice(data.caryear.indexOf(+e),1);
                sessionStorage.caryear=JSON.stringify(data.caryear);
                search_adv.$set('data.caryear',data.caryear)
            }
        },
        click_carbody:function (e) {
            if(data.carbody.indexOf(+e)==-1){
                data.carbody.push(+e);
                sessionStorage.carbody=JSON.stringify(data.carbody);
                search_adv.$set('data.carbody',data.carbody)
            }else {
                data.carbody.splice(data.carbody.indexOf(+e),1);
                sessionStorage.carbody=JSON.stringify(data.carbody);
                search_adv.$set('data.carbody',data.carbody)
            }
        },
        click_fueltype:function (e) {
            if(data.fueltype.indexOf(+e)==-1){
                data.fueltype.push(+e);
                sessionStorage.fueltype=JSON.stringify(data.fueltype);
                search_adv.$set('data.fueltype',data.fueltype)
            }else {
                data.fueltype.splice(data.fueltype.indexOf(+e),1);
                sessionStorage.fueltype=JSON.stringify(data.fueltype);
                search_adv.$set('data.fueltype',data.fueltype)
            }
        },
        click_transmission:function (e) {
            if(data.transmission.indexOf(+e)==-1){
                data.transmission.push(+e);
                sessionStorage.transmission=JSON.stringify(data.transmission);
                search_adv.$set('data.transmission',data.transmission)
            }else {
                data.transmission.splice(data.transmission.indexOf(+e),1);
                sessionStorage.transmission=JSON.stringify(data.transmission);
                search_adv.$set('data.transmission',data.transmission)
            }
        },
        click_displacement:function (e) {
            if(data.displacement.indexOf(e)==-1){
                data.displacement.push(e);
                sessionStorage.displacement=JSON.stringify(data.displacement);
                search_adv.$set('data.displacement',data.displacement)
            }else {
                data.displacement.splice(data.displacement.indexOf(e),1);
                sessionStorage.displacement=JSON.stringify(data.displacement);
                search_adv.$set('data.displacement',data.displacement)
            }
        },
        click_drivemode:function (e) {
            if(data.drivemode.indexOf(+e)==-1){
                data.drivemode.push(+e);
                sessionStorage.drivemode=JSON.stringify(data.drivemode);
                search_adv.$set('data.drivemode',data.drivemode)
            }else {
                data.drivemode.splice(data.drivemode.indexOf(+e),1);
                sessionStorage.drivemode=JSON.stringify(data.drivemode);
                search_adv.$set('data.equiptment',data.drivemode)
            }
        }

    },

});

//      延迟一秒执行事件 防止数据未渲染完成 事件执行不了
setTimeout(function () {
    $('#consumption li').click(function (e) {
        var val=$(this).attr('id');
        if(sessionStorage.consumption&&sessionStorage.consumption==val){
            sessionStorage.consumption='';
            data.consumption='';
            search_adv.$set('data.consumption',data.consumption)
        }else {
            sessionStorage.consumption=val;
            data.consumption=val;
            search_adv.$set('data.consumption',data.consumption)
        }
    });
    $("#Price_sector li").click(function() {
        var val=$(this).attr('id');
        if(data.Price_sector.indexOf(val)==-1){
            data.Price_sector.push(val);
            sessionStorage.Price_sector=JSON.stringify(data.Price_sector);
            search_adv.$set('data.Price_sector',data.Price_sector)
        }else {
            data.Price_sector.splice(data.Price_sector.indexOf(val),1);
            sessionStorage.Price_sector=JSON.stringify(data.Price_sector);
            search_adv.$set('data.Price_sector',data.Price_sector)
        }
    });
    $("#passenger li").click(function() {
        var val=$(this).attr('id');
        if(data.passenger.indexOf(val)==-1){
            data.passenger.push(val);
            sessionStorage.passenger=JSON.stringify(data.passenger);
            search_adv.$set('data.passenger',data.passenger)
        }else {
            data.passenger.splice(data.passenger.indexOf(val),1);
            sessionStorage.passenger=JSON.stringify(data.passenger);
            search_adv.$set('data.passenger',data.passenger)
        }
    });
    $("#cardoor li").click(function() {
        var val=$(this).attr('id');
        if(data.cardoor.indexOf(val)==-1){
            data.cardoor.push(val);
            sessionStorage.cardoor=JSON.stringify(data.cardoor);
            search_adv.$set('data.cardoor',data.cardoor)
        }else {
            data.cardoor.splice(data.cardoor.indexOf(val),1);
            sessionStorage.cardoor=JSON.stringify(data.cardoor);
            search_adv.$set('data.cardoor',data.cardoor)
        }
    });
    $("#equiptment li").click(function() {
        var val=$(this).attr('id');
        if(data.equiptment.indexOf(val)==-1){
            data.equiptment.push(val);
            sessionStorage.equiptment=JSON.stringify(data.equiptment);
            search_adv.$set('data.displacement',data.equiptment)
        }else {
            data.equiptment.splice(data.equiptment.indexOf(val),1);
            sessionStorage.displacement=JSON.stringify(data.equiptment);
            search_adv.$set('data.equiptment',data.equiptment)
        }
    });
},500);

//            页面跳转
$('#btn-m').click(function () {
    sessionStorage.key_content=$('#keywords').val();
    location.href='search.html';
})

$(document).on('click','.clearfix li',function (e) {
    if($(this).hasClass('c_color_selced')){
        $(this).removeClass('c_color_selced')
    }else {
        if($(this).parent().attr('id')!='consumption'){
            $(this).addClass('c_color_selced');
        }else {
            $("#consumption > li").removeClass('c_color_selced');
            $(this).addClass('c_color_selced');
        }
    }
});
