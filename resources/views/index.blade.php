# Función para calcular el promedio de una lista de números
def calcular_promedio(lista_numeros):
    """
    Calcula el promedio de una lista de números.

    Parámetros:
    lista_numeros (list): Lista de números.

    Retorna:
    float: Promedio de los números en la lista.
    """
    # Verificar si la lista está vacía
    if len(lista_numeros) == 0:
        return 0  # Devolver 0 si la lista está vacía

    # Inicializar la suma
    suma = 0

    # Iterar sobre los números en la lista y sumarlos
    for numero in lista_numeros:
        suma += numero

    # Calcular el promedio dividiendo la suma entre la cantidad de números
    promedio = suma / len(lista_numeros)

    return promedio
