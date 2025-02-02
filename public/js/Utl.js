class Utl {

    static isEmptyString(value) {

        try {

            if(typeof(value) === "string" || value instanceof String) {
                if(value.length >= 1) {
                    return false;
                } else {
                    throw "El String se encuentra vacío";
                }
            } else {
                throw "El parámetro pasado no es un String"
            }
            
        } catch(e) {
            return true;
        }
    }
}