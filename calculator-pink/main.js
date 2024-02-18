let num1 = ''
let num2 = ''
let operator = ''
let finish = false
const list = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.']
const action = ['+', '-', '/', 'X', '%']
const output = document.querySelector('.output')

function clearAll() {
	num1 = ''
	num2 = ''
	operator = ''
	finish = false
	output.textContent = '0'
}

document.querySelector('#clearAll').onclick = clearAll

document.querySelector('.buttons').onclick = event => {
	if (!event.target.classList.contains('btn')) return
	if (event.target.classList.contains('ac')) return
	output.textContent = ''
	const key = event.target.textContent

	if (list.includes(key)) {
		if (num2 === '' && operator === '') {
			num1 += key
			output.textContent = num1
			// console.log(a, b, operator)
		} else if (num1 !== '' && num2 !== '' && finish) {
			num2 = key
			finish = false
			output.textContent = num2
		} else {
			num2 += key
			output.textContent = num2
		}
		console.log(num1, num2)
	}
	if (action.includes(key)) {
		operator = key
		output.textContent = operator
		console.log(operator)
		return
	}
	if (key === '=') {
		if (num2 === '') {
			num2 = num1
		}
		switch (operator) {
			case '+':
				num1 = +num1 + +num2
				break
			case '-':
				num1 = +num1 - +num2
				break
			case 'X':
				num1 = +num1 * +num2
				break
			case '/':
				num1 = +num1 / +num2
				break
		}
		finish = true
		output.textContent = num1
		console.log(num1, operator, num2)
	}
}
