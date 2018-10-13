/* GCD of two numbers
 */

gcd( X, X, X).

gcd( X, Y, D):-
	Y > X,
	Y1 is Y - X,
	gcd( X, Y1, D).

gcd( X, Y, D):-
	X > Y,
	gcd( Y, X, D).

