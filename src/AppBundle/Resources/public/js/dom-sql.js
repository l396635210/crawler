/**
 * Created by lenovo on 2016/6/27.
 */
var DomSQL = function(){

    var condition = {};
    var filter = [];

    var conf = {
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
        var toQuery = conf["toQuery"];
        var likeNode = conf["likeNode"];
        $(toQuery).hide();
        var where = json2selectorCondition(condition);
        var like = filter;
        $(toQuery+where).each(function(){
            var query = toQuery == likeNode ? $(this) : $(this).find(likeNode);
            var show = true;
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
    var condition = "";
    if(!$.isEmptyObject(json)){
        var data = JSON.stringify(json);
        var map = { '{"':'[', ',"':'][', '}':']', '":':'=' };
        condition = data.replace(/{"|,"|}|":/gi, function(matched){
            return map[matched];
        });
    }
    return condition;
};