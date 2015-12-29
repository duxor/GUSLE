/**
 * Created by Dušan on 12/26/2015.
 */
var cirilo={
    init:function(){
        $('[data-serbian=true]').focus(function(){
            $(this).closest('div').append('<div class="alert srpsko-uputstvo"><footer><b>ћ .ц.</b> | <b>ч ,ц,</b> | <b>ђ .д,</b> | <b>љ .л, или q</b> | <b>њ .н, или w</b> | <b>џ .дз. или џ</b> | <b>ш .с.</b></footer></div>');
        });
        $('[data-serbian=true]').blur(function(){
            $('.srpsko-uputstvo').remove();
        });
        $('[data-serbian=true]').keypress(function(e){
            var
                cirilica = 'абвгдезијклмнњопрстуфхцчћђжшљњџАБВГДЂЕЖЗИЈКЛМНОПРСТУФХЦЧЋЂЖШЏЉЊзЗ',//Ђ Љ Њ Ж Ч Џ Ш
                latinica = 'abvgdezijklmnnoprstufhcčćđžšqwxABVGDDEZZIJKLMNOPRSTUFHCČĆĐŽŠXQWyY',
                slovo=String.fromCharCode(e.keyCode),
                test=false,
                cursorStart=$(this)[0].selectionStart;
            if(latinica.indexOf(String.fromCharCode(e.keyCode))>=0)
                slovo=cirilica.charAt(latinica.indexOf(slovo));
            $(this).val(
                $(this).val().substring(0,cursorStart)+
                slovo+
                $(this).val().substring($(this)[0].selectionEnd)
            );
            $(this).val($(this).val()
                .replace(/\.ц\./g,'ћ').replace(/\.Ц\./g,'Ћ')
                .replace(/,ц,/g,'ч').replace(/,Ц,/g,'Ч')
                .replace(/\.д,/g,'ђ').replace(/\.Д,/g,'Ђ')
                .replace(/\.л,/g,'љ').replace(/\.Л,/g,'Љ')
                .replace(/\.н,/g,'њ').replace(/\.Н,/g,'Њ')
                .replace(/\.дз\./g,'џ').replace(/\.ДЗ./g,'Џ')
                .replace(/\.с\./g,'ш').replace(/\.С\./,'Ш'));
            cirilo.setCursor($(this)[0],cursorStart);
            e.preventDefault();

        })
    },
    setCursor:function(input, start) {
        input.selectionStart=start+1;
        input.selectionEnd=start+1;
    }
}