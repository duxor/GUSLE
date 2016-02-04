/**
 * Created by Dušan on 12/26/2015.
 */
var cirilo={
    init:function(idPrikaz,btn){
        cirilo.reset();
        $('[data-serbian=true]').focus(function(){
            if(btn) $(btn).css('opacity',0.5);
            if(idPrikaz)
                $(idPrikaz).html('<div class="alert srpsko-uputstvo"><footer style="float:left;padding: 10px 10px 0 0"><b>ћ .ц.</b> | <b>ч ,ц,</b> | <b>ђ .д,</b> | <b>љ .л, или q</b> | <b>њ .н, или w</b> | <b>џ .дз. или џ</b> | <b>ш .с.</b></footer> <button class="btn btn-c"><i class="glyphicon glyphicon-floppy-disk"></i> Заврши унос</button></div>');
            else if($(this).data('serbian-id'))
                $($(this).data('serbian-id')).html('<div class="alert srpsko-uputstvo"><footer style="float:left;padding: 10px 10px 0 0"><b>ћ .ц.</b> | <b>ч ,ц,</b> | <b>ђ .д,</b> | <b>љ .л, или q</b> | <b>њ .н, или w</b> | <b>џ .дз. или џ</b> | <b>ш .с.</b></footer> <button class="btn btn-c"><i class="glyphicon glyphicon-floppy-disk"></i> Заврши унос</button></div>');
            else
                $(this).closest('div').append('<div class="alert srpsko-uputstvo"><footer><b>ћ .ц.</b> | <b>ч ,ц,</b> | <b>ђ .д,</b> | <b>љ .л, или q</b> | <b>њ .н, или w</b> | <b>џ .дз. или џ</b> | <b>ш .с.</b> <button class="btn btn-c"><i class="glyphicon glyphicon-floppy-disk"></i> Заврши унос</button></footer></div>');
        });
        $('[data-serbian=true]').blur(function(){
            if(btn) $(btn).css('opacity',1);
            $('.srpsko-uputstvo').remove();
        });
        $('[data-serbian=true]').keypress(function(e){
            var
                cirilica = 'абвгдезијклмнњопрстуфхцчћђжшљњџАБВГДЂЕЖЗИЈКЛМНОПРСТУФХЦЧЋЂЖШЏЉЊзЗ',//Ђ Љ Њ Ж Ч Џ Ш
                latinica = 'abvgdezijklmnnoprstufhcčćđžšqwxABVGDDEZZIJKLMNOPRSTUFHCČĆĐŽŠXQWyY',
                slovo=String.fromCharCode(e.charCode||e.keyCode),
                test=false,
                cursorStart=$(this)[0].selectionStart;
            if(latinica.indexOf(slovo)>=0){
                test=true;
                slovo=cirilica.charAt(latinica.indexOf(slovo));
            }
            if($.inArray(slovo,['.',','])>-1||test){
                test=true;
                $(this).val(
                    $(this).val().substring(0,cursorStart)+
                    slovo+
                    $(this).val().substring($(this)[0].selectionEnd)
                );
            }
            $(this).val($(this).val()
                .replace(/\.ц\./g,'ћ').replace(/\.Ц\./g,'Ћ')
                .replace(/,ц,/g,'ч').replace(/,Ц,/g,'Ч')
                .replace(/\.д,/g,'ђ').replace(/\.Д,/g,'Ђ')
                .replace(/\.л,/g,'љ').replace(/\.Л,/g,'Љ')
                .replace(/\.н,/g,'њ').replace(/\.Н,/g,'Њ')
                .replace(/\.дз\./g,'џ').replace(/\.ДЗ./g,'Џ')
                .replace(/\.с\./g,'ш').replace(/\.С\./,'Ш'));
            cirilo.setCursor($(this)[0],cursorStart);
            if(test) e.preventDefault();
        })
    },
    setCursor:function(input, start){
        input.selectionStart=start+1;
        input.selectionEnd=start+1;
    },
    reset:function(){
        $('[data-serbian=true]').off('focus');
        $('[data-serbian=true]').off('blur');
        $('[data-serbian=true]').off('keypress');
    }
}