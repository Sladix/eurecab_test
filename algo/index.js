'use strict';

// Implementation using Array prototype method
// Complexity: O(n)
function valuePosition(arr, numberToFind) {
    return arr.indexOf(numberToFind);
}

// Implementation using a for loop
// Complexity: O(n)
function valuePositionLoop(arr, numberToFind) {
    for (let i = 0; i < arr.length; i++) {
        if (arr[i] === numberToFind) {
            return i;
        }
    }
    return -1;
}

/-- Tests --/

let tests = [
    {
        input: [[0, 1, 2], 2],
        expected: 2
    },
    {
        input: [[1337, 1, 2], 1337],
        expected: 0
    },
    {
        input: [[3, 2, 1], -1],
        expected: -1
    },
    {
        input: [[1, -1, 3], -1],
        expected: 1
    },
    {
        input: [[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12], 9],
        expected: 8
    }
];

test(tests, valuePosition);
test(tests, valuePositionLoop);

function expect(result, expected) {
    return new Promise((resolve, reject) => {
        if (expected === result) {
            resolve(true);
        } else {
            reject(new Error(`Expected ${expected}, got ${result}`));
        }
    })
}

function test(tests, func) {
    let promises = [];
    for (let i = 0; i < tests.length; i++) {
        let test = tests[i];
        let result = func.apply(null, test.input);
        promises.push(expect(result, test.expected));
    }
    console.time(func.name);
    Promise.all(promises).then(() => {

        console.log(`All tests passed for ${func.name}`);
        console.timeEnd(func.name);
    }).catch(e => {
        console.log(`An error occured during tests: ${e.message}`);
    });
}