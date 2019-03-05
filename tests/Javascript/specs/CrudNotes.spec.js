import { createLocalVue, mount } from '@vue/test-utils';
import VueRouter from 'vue-router';
import expect from 'expect';
import CrudNotes from '../../../resources/js/views/CrudNotes.vue';
import router from '../../../resources/js/routes';

describe('CrudNotes.vue', () => {
  let component;

  beforeEach(() => {
    const localVue = createLocalVue();
    localVue.use(VueRouter);

    component = mount(CrudNotes, {
        attachToDocument: true,
        localVue,
        router
    });
  });

  it('contains CrudNotes', () => {
    expect(component.vm.$route).toBeInstanceOf(Object);
    expect(component.find('.btn-primary').text()).toBe('Add');
    expect(component.contains('table')).toBe(true);
    expect(component.find('table tr th').text()).toBe('Title');
  });

});
