#!/usr/bin/env python
import subprocess
import json
import os

def countInputInFile(pathToFile): # подсчет количества input в файле
    f = open(pathToFile, 'r', encoding="utf-8")
    s = f.readlines()
    fileToSting = ''
    for i in range(len(s)):
        fileToSting += s[i]
    return fileToSting.count('input')


def start(executable_file): #запуск тестирующего файла
    return subprocess.Popen(
        executable_file,
        stdin=subprocess.PIPE,
        stdout=subprocess.PIPE,
        stderr=subprocess.PIPE,
        shell=True)


def read(process): #вывод результата тестирующего файла
    return process.stdout.readlines()


def write(process, message): #вввод данных в тестирующий файл
    process.stdin.write(f"{message.strip()}\n".encode("utf-8"))
    process.stdin.flush()


def Tests(): #основной блок проверки
    fvalues = open('values.txt', 'r', encoding="utf-8")
    values = fvalues.readline().split(' ')
    testsDirectory = values[1]
    testFile = 'download\\'+values[0]
    countFiles = len(os.listdir(testsDirectory)) #определение директории файлов теста
    countRight = 0
    countIncorrect = 0
    countTest = 0
    for i in range(1, countFiles // 2 + 1): # проход по всем файлам теста по очереди
        numberFile = i
        testingFile = testsDirectory + '/input' + str(numberFile) + '.txt'
        testsFile = testsDirectory + '/output' + str(numberFile) + '.txt'
        inputFile = open(f"{testingFile}", 'r', encoding="utf-8")
        outputFile = open(f"{testsFile}", 'r', encoding="utf-8")
        countInput = countInputInFile(testFile)
        inputData = inputFile.readlines()
        outputData = outputFile.readlines()
        process = start(f"{testFile}")
        for j in range(countInput): # ввод данных в тестирующийся файл
            write(process, inputData[j].replace('\n',''))
        arrayResult = read(process)
        flag = True
        for j in range(len(arrayResult)): # получение данных результата тестирующего файла и проверка с правильными ответами
            result = str(arrayResult[j]).replace('b\'','').replace('\\r\\n\'','')
            if outputData[j].replace('\n','') != result:
                flag = False
        if flag:
            countRight += 1
        countTest += 1
        inputFile.close()
        outputFile.close()
    return writeResult(int(countRight / countTest * 100))



def writeResult(result):
    f = open('result.txt', 'w', encoding="utf-8")
    f.write(str(result))


Tests()
print('OK')
