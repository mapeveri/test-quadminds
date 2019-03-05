import { createLocalVue, mount } from '@vue/test-utils';
import VueRouter from 'vue-router';
import expect from 'expect';
import App from '../../../resources/js/views/App.vue';
import router from '../../../resources/js/routes';

describe('App.vue', () => {
  let component;

  beforeEach(() => {
    const localVue = createLocalVue();
    localVue.use(VueRouter);

    component = mount(App, {
        attachToDocument: true,
        localVue,
        router
    });
  });

  it('contains App', () => {
    expect(component.vm.$route).toBeInstanceOf(Object);
    expect(component.html()).toContain('Notes');
  });

});
