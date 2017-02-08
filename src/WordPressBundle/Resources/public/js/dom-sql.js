/**
 * Created by lenovo on 2016/6/27.
 */
var DomSQL = function(){

    let condition = {};
    let filter = [];

    let conf = {
        toQuery   : ".toQuery" ,
        likeNode  : ".toQuery"
    };

    this.config = function(obj){
        conf["toQuery"] = obj["toQuery"] || conf["toQuery"];
        conf["likeNode"] = obj["likeNode"] || obj["toQuery"] || conf["toQuery"];
    };
    this.like = function(keyword){
        filter = keyword.split(" ");
        return this;
    };

    this.where = function(key, val){
        if(val){
            condition[key] = val;
        }else{
            delete condition[key];
        }
        return this;
    };

    this.reset =function(){
        condition = {};
        filter    = [];
        this.query();
    };

    this.query = function(){
        let toQuery = conf["toQuery"];
        let likeNode = conf["likeNode"];
        $(toQuery).hide();
        let where = json2selectorCondition(condition);
        let like = filter;
        $(toQuery+where).each(function(){
            let query = toQuery == likeNode ? $(this) : $(this).find(likeNode);
            let show = true;
            for(item in like){
                if(!query.text().includes(like[item])){
                    show = false;
                    break;
                }
            }
            if(show) $(this).show();
        });
    };

};

//json对象转[key=val][key=val]...
var json2selectorCondition = function(json){
    let condition = "";
    if(!$.isEmptyObject(json)){
        let data = JSON.stringify(json);
        let map = { '{"':'[', ',"':'][', '}':']', '":':'=' };
        condition = data.replace(/{"|,"|}|":/gi, function(matched){
            return map[matched];
        });
    }
    return condition;
};