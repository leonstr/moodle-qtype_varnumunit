<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Test helpers for the varnumunit question type.
 *
 * @package    qtype
 * @subpackage varnumunit
 * @copyright  2012 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Test helper class for the varnumunit question type.
 *
 * @copyright  2012 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_varnumunit_test_helper extends question_test_helper {
    public function get_test_questions() {
        return array('3_sig_figs_with_m_unit', '3_sig_figs_with_units_meters_per_second');
    }

    /**
     * @return qtype_varnumunit_question
     */
    public function make_varnumunit_question_3_sig_figs_with_m_unit() {
        question_bank::load_question_definition_classes('varnumunit');
        $vu = new qtype_varnumunit_question();
        test_question_maker::initialise_a_question($vu);
        $vu->name = 'test question 1';
        $vu->questiontext = '<p>The correct answer is 12300.</p>';
        $vu->generalfeedback = '<p>General feedback 12300.</p>';
        $vu->penalty = 0.3333333;
        $vu->randomseed = '';
        $vu->requirescinotation = 0;
        $vu->unitfraction = '0.2500000';
        $vu->qtype = question_bank::get_qtype('varnumunit');

        $vu->answers = array(1 => new qtype_varnumericset_answer(
                                                 '1', // id
                                                 '12345',  // answer
                                                 '1',  // fraction
                                                 '<p>Your answer is correct.</p>', // feedback
                                                 'html', // feedbackformat
                                                 '3', // sigfigs
                                                 '', // error
                                                 '0.1', // syserrorpenalty
                                                 '0', // checknumerical
                                                 '0', // checkscinotation
                                                 '4', // checkpowerof10
                                                 '0'), // checkrounding
                            2 => new qtype_varnumericset_answer(
                                                 '2',  // id
                                                 '*',  // answer
                                                 '0',  // fraction
                                                 '<p>Your answer is incorrect.</p>', // feedback
                                                 'html', // feedbackformat
                                                 '0', // sigfigs
                                                 '', // error
                                                 '0.1000000', // syserrorpenalty
                                                 '0', // checknumerical
                                                 '0', // checkscinotation
                                                 '0', // checkpowerof10
                                                 '0')); // checkrounding);

        $vu->options = new stdClass();
        $vu->options->units = array(
                            1 => new qtype_varnumunit_unit(
                                                '1',
                                                'match(m)',
                                                '1',
                                                '1',
                                                '1.0000000',
                                                '<p>Good!</p>',
                                                '1'),
                            2 => new qtype_varnumunit_unit(
                                        '2',
                                        '*',
                                        '1',
                                        '1',
                                        '0.0000000',
                                        '',
                                        '1'));
        $calculatorname = $vu->qtype->calculator_name();
        $vu->calculator = new $calculatorname();
        $vu->calculator->evaluate_variant(0);
        return $vu;
    }

    /**
     * @return qtype_varnumunit_question
     */
    public function make_varnumunit_question_3_sig_figs_with_units_meters_per_second() {
        question_bank::load_question_definition_classes('varnumunit');
        $vu = new qtype_varnumunit_question();
        test_question_maker::initialise_a_question($vu);
        $vu->name = 'test question 2';
        $vu->questiontext = 'The correct answer is 4000 m/s or 4e3 ms<sup>-1</sup> etc..';
        $vu->generalfeedback = 'General feedback, blah blah.';
        $vu->penalty = '0.2000000';
        $vu->randomseed = '';
        $vu->requirescinotation = '1';
        $vu->unitfraction = '0.1000000';
        $vu->qtype = question_bank::get_qtype('varnumunit');
        $vu->answers = array(1 => new qtype_varnumericset_answer('1', // id
                                '4000',  // answer
                                '1',  // fraction
                                '<p>Your answer is correct.</p>', // feedback
                                'html', // feedbackformat
                                '4', // sigfigs
                                '', // error
                                '0.1000000', // syserrorpenalty
                                '0', // checknumerical
                                '0', // checkscinotation
                                '4', // checkpowerof10
                                '0'), // checkrounding
                             2 => new qtype_varnumericset_answer('2', // id
                                 '*',  // answer
                                 '0',  // fraction
                                 '<p>Your answer is incorrect.</p>', // feedback
                                 'html', // feedbackformat
                                 '0', // sigfigs
                                 '', // error
                                 '0.1000000', // syserrorpenalty
                                 '0', // checknumerical
                                 '0', // checkscinotation
                                 '0', // checkpowerof10
                                 '0')); // checkrounding);

        $vu->options = new stdClass();
        $vu->options->units = array(
            1 => new qtype_varnumunit_unit(
                '1',
                'match(ms<sup>-1</sup>)',
                '1',
                '1',
                '1.0000000',
                '<p>Good!</p>',
                '1'),
            2 => new qtype_varnumunit_unit(
                '1',
                'match(m/s)',
                '1',
                '1',
                '1.0000000',
                '<p>Good!</p>',
                '1'),
            3 => new qtype_varnumunit_unit(
                '2',
                '*',
                '1',
                '1',
                '0.0000000',
                '',
                '1'));
        $calculatorname = $vu->qtype->calculator_name();
        $vu->calculator = new $calculatorname();
        $vu->calculator->evaluate_variant(0);
        return $vu;
    }

}