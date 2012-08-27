    <div id="formApplication">		
        <b>Задание 1</b><br/>
        <form>  

            <span >Сайт:</span>
            <input type="text" name="siteToSearch" id="siteToSearch" onkeyup="checkSite(this.form);" onchange="checkSite(this.form);"/>

                    <a href="/mvc/table" style="float:right;">Результаты поиска</a><br/>

            <span id="spanMethod" style="display:none;">Искать:</span>

            <select id="selectSearchMethod" size="1" onchange="searchMethod(this.form);" style="display:none;">
                <option value="selectLinks" selected="selected">ссылки</option>
                <option value="selectPictures">картинки</option>
                <option value="selectCustom">свой текст</option>
            </select><br/>

            <span id="spanPattern" style="display:none;">Pattern:</span>            
            <input type="text" name="searchPattern" id="searchPattern" style="display:none;"/><br/>

            <a href="#" onclick="sendSearchRequest();">Искать</a>

        </form>			

        <div id="responseDiv">
        </div>
    </div>